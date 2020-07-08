<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\ProdukMasuk;
use App\penjualan;
use App\produk;

class PenjualanController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $jual = Penjualan::orderBy('id_produk','asc')->get();
        return view('penjualan.index',compact('jual'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $jual = penjualan::select('produks.nama','penjualans.jumlah','penjualans.tanggal','penjualans.id_produk')
                ->join('produks','produks.id','=','penjualans.id_produk')
                ->where('produks.nama','like',"%".$cari."%")
                ->orwhere('penjualans.jumlah','like',"%".$cari."%")
                ->orwhere('penjualans.tanggal','like',"%".$cari."%")
                ->paginate();
        return view('penjualan.index',compact('jual'));
    }

    public function tambah(Request $request){
        if($request->isMethod('get')){
            $produk = produk::all();
        return view('penjualan.tambah',compact('produk'));
        }else{
            $rules = [
                'produk'  => 'required',
                'tanggal' => 'required',
                'jumlah' => 'required',
            ];
            $pesan = [
                'produk'  => 'Produk Penjualan Tidak Boleh Kosong',
                'tanggal' => 'Tanggal Penjualan Tidak Boleh Kosong',
                'jumlah' => 'Jumlah Penjualan Tidak Boleh Kosong',
            ];
            $v = Validator :: make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $jual = new penjualan();
                $jual->id_produk = $request->get('produk');
                $jual->tanggal = $request->get('tanggal');
                $jual->jumlah = $request->get('jumlah');

                if($jual->save())
                {
                    $produk = produk::findOrFail($request->produk);
                    $produk->stok = $produk->stok - $request->jumlah;
                    $produk->update();
                }
                return redirect ('penjualan/index');
            }
        }
    }

    public function edit(Request $request,$id){
        $jual = penjualan::where('id',$id)->get();
        $produk = produk::all();
        return view('penjualan.edit',compact('jual','produk'));
    }

    public function update(Request $request,$id){
        $rules = [

            'tanggal' => 'required',
            'jumlah' => 'required',
        ];
        $pesan = [
            'tanggal' => 'Tanggal Penjualan Tidak Boleh Kosong',
            'jumlah' => 'Jumlah Penjualan Tidak Boleh Kosong',
        ];
        $v = Validator :: make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
            $jual = penjualan::find($id);
            $jual->id_produk = $request->get('produk');
            $jual->tanggal = $request->get('tanggal');
            $jual->jumlah = $request->get('jumlah');
            if($jual->update()){
                //untuk table produk
                $total_produk_masuk = ProdukMasuk::where('id_produk',$jual->id_produk)->sum('jumlah');
                $total_produk_keluar = penjualan::where('id_produk',$jual->id_produk)->sum('jumlah');
                $update_produk = produk::find($jual->id_produk);
                $update_produk->stok = $total_produk_masuk - $total_produk_keluar;
                $update_produk->update();
            }

            return redirect ('penjualan/index');
        }
    }
    public function delete($id){
        $penjualan_del = penjualan::findOrfail($id);
        if($penjualan_del->delete())
        {
            //untuk table produk
            $total_produk_masuk = ProdukMasuk::where('id_produk',$penjualan_del->id_produk)->sum('jumlah');
            $total_produk_keluar = penjualan::where('id_produk',$penjualan_del->id_produk)->sum('jumlah');
            $update_produk = produk::find($penjualan_del->id_produk);
            $update_produk->stok = $total_produk_masuk - $total_produk_keluar;
            $update_produk->update();
        }
        return response()->json(['status' => 'Data Penjualan Telah Berhasil Di hapus']);
    }




}
