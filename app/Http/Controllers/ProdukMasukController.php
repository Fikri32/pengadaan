<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\produk;
use App\ProdukMasuk;
use App\Penjualan;
use Carbon\Carbon;

class ProdukMasukController extends Controller
{
    public function index()
    {
        $masuk = ProdukMasuk::orderBy('id_produk','asc')->get();

        return view('produk_masuk.index',compact('masuk'));
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $masuk = ProdukMasuk::select('produks.nama','produks_masuk.jumlah','produks_masuk.tanggal','produks_masuk.id_produk')
                ->join('produks','produks.id','=','produks_masuk.id_produk')
                ->where('produks.nama','like',"%".$cari."%")
                ->orwhere('produks_masuk.jumlah','like',"%".$cari."%")
                ->orwhere('produks_masuk.tanggal','like',"%".$cari."%")
                ->paginate();
        return view('produk_masuk.index',compact('masuk'));
    }

    public function tambah(Request $request)
    {
        if($request->isMethod('get'))
        {
            $produk = produk::all();
            return view('produk_masuk.tambah',compact('produk'));

        }else{
            $rules = [
                'produk' => 'required',
                'tanggal' => 'required',
                'jumlah' => 'required'
            ];

            $pesan = [
                'produk' => 'required',
                'tanggal' => 'required',
                'jumlah' => 'required'
            ];

            $v = Validator::make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);

            }else{
                $masuk = new ProdukMasuk();
                $masuk->id_produk = $request->get('produk');
                $tanggal = $request->get('tanggal');

                $masuk->tanggal = Carbon::parse($tanggal)->addDays(1);
                $masuk->jumlah = $request->get('jumlah');
                if($masuk->save()){

                $produk = produk::findOrFail($request->produk);
                $produk->stok += $request->jumlah;
                $produk->update();
                }
            }
            return redirect('produkmasuk/index');
        }
    }
    public function edit(Request $request,$id)
    {
        $masuk = ProdukMasuk::where('id',$id)->get();
        $produk = produk::all();
        // $masuk = ProdukMasuk::select('produks_masuk.jumlah')->get();
        //     $array = array();
        //     for($i = 0;$i<=count($masuk);$i++){
        //         $array[$i] = intval($masuk[$i]['jumlah']);
        //     break;
        //         dd($array[$i]);
        //     }
        return view('produk_masuk.edit',compact('masuk','produk'));
    }

    public function update(Request $request,$id)
    {
        $rules = [
            'produk' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required'
        ];

        $pesan = [
            'produk' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required'
        ];

        $v = Validator::make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
            $masuk = ProdukMasuk::find($id);
            $masuk->id_produk = $request->get('produk');
            $tanggal = $request->get('tanggal');
            $masuk->tanggal = Carbon::parse($tanggal)->addDays(1);
            $masuk->jumlah = $request->get('jumlah');
            if($masuk->update()){
                //untuk table produk
                $total_produk_masuk = ProdukMasuk::where('id_produk',$masuk->id_produk)->sum('jumlah');
                $total_produk_keluar = penjualan::where('id_produk',$masuk->id_produk)->sum('jumlah');
                $update_produk = produk::find($masuk->id_produk);
                $update_produk->stok = $total_produk_masuk - $total_produk_keluar;
                $update_produk->update();
            }
        }
        return redirect('produkmasuk/index');
    }
    public function delete($id){
        $masuk_del = ProdukMasuk::findOrfail($id);
        if($masuk_del->delete())
        {
            //untuk table produk
            $total_produk_masuk = ProdukMasuk::where('id_produk',$masuk_del->id_produk)->sum('jumlah');
            $total_produk_keluar = penjualan::where('id_produk',$masuk_del->id_produk)->sum('jumlah');
            $update_produk = produk::find($masuk_del->id_produk);
            $update_produk->stok = $total_produk_masuk - $total_produk_keluar;
            $update_produk->update();
        }
        return response()->json(['status' => 'Data Produk Masuk Berhasil Di Hapus']);
    }
}
