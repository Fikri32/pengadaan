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
                $masuk->save();
                $produk = produk::find($request->produk);
                $produk->stok = $produk->stok + $request->jumlah;
                $produk->save();
            }
            return redirect('produkmasuk/index');
        }
    }
    public function edit(Request $request,$id)
    {
        $masuk = ProdukMasuk::where('id',$id)->get();
        $produk = produk::all();
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
            $masuk->save();
            $produk = produk::find($request->produk);
            $produk->stok = $produk->stok + $request->jumlah;
            $produk->save();
        }
        return redirect('produkmasuk/index');
    }
    public function delete($id){
        $masuk_del = ProdukMasuk::findOrfail($id);
        $masuk_del->delete();
        return response()->json(['status' => 'Data Produk Masuk Berhasil Di Hapus']);
    }
}
