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
        $masuk = ProdukMasuk::whereHas('produk', function ($query) use ($cari){
            $query->where('nama', 'like', '%'.$cari.'%')
                  ->orWhere('jumlah','like','%'.$cari.'%') ;

        })
        ->with(['produk' => function($query) use ($cari){
            $query->where('nama', 'like', '%'.$cari.'%'  );
        }])->get();
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
                $masuk->tanggal = $request->get('tanggal');
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
            $masuk->tanggal = $request->get('tanggal');
            $masuk->jumlah = $request->get('jumlah');
            if($masuk->update()){
            $masuk = ProdukMasuk::select('produks_masuk.jumlah')->pluck('jumlah');
            // $array = array();
            // for($i = 0; $i<count($masuk); $i++){
            //     $array[$i] = intval($masuk[$i]['jumlah']);
            //     dd($masuk[$i]);
            // break;
            // }

            $produk = produk::find($request->produk);
            $hitung = ProdukMasuk::all()->count();
            if($hitung == 1){
                $produk->stok = $produk->stok - $produk->stok + $request->jumlah;
            }else{

                $produk->stok = $produk->stok - $produk->stok + $request->jumlah ;

            }
            $produk->update();
            }
        }
        return redirect('produkmasuk/index');
    }
    public function delete($id){
        $masuk_del = ProdukMasuk::findOrfail($id);
        $masuk_del->delete();
        return response()->json(['status' => 'Data Produk Masuk Berhasil Di Hapus']);
    }
}
