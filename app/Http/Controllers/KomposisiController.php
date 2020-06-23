<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Redirect;
use DB;
use App\Komposisi;
use App\produk;
use App\BahanBaku;

class KomposisiController extends Controller
{
    public function index(Request $request,$id){
        $komposisi = Komposisi::where('id_produk',$id)->get();
        $produk = produk::where('id',$id)->get();
        $bahan = BahanBaku::all();
        //  dd($komposisi);
        return view('komposisi.tambah',compact('komposisi','bahan','produk'));

    }
    public function edit(Request $request,$id){
        $komposisi = Komposisi::where('id_produk',$id)->get();
        $produk = produk::where('id',$id)->get();
        $bahan = BahanBaku::all();
         // dd($produk);
        return view('komposisi.update',compact('komposisi','bahan','produk'));

    }
    public function tambah(Request $request){
            $rules = [
                'bahan'  => 'required',
                'jumlah' => 'required',

            ];
            $pesan = [
                'bahan'  => 'Produk Komposisi Tidak Boleh Kosong',
                'jumlah' => 'Jumlah Komposisi Tidak Boleh Kosong',
            ];
            $v = Validator :: make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $komposisi = new Komposisi();
                $komposisi->id_bahanbaku = $request->get('bahan');
                $komposisi->id_produk = $request->get('produk');
                $komposisi->jumlah = $request->get('jumlah');

                $komposisi->save();
                return redirect ('produk/index');
            }

    }
    public function update(Request $request,$id){
        $rules = [
            'bahan'  => 'required',
            'jumlah' => 'required',

        ];
        $pesan = [
            'bahan'  => 'Produk Komposisi Tidak Boleh Kosong',
            'jumlah' => 'Jumlah Komposisi Tidak Boleh Kosong',
        ];
        $v = Validator :: make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
            $komposisi = Komposisi::find($id);
            $komposisi->id_bahanbaku = $request->get('bahan');
            $komposisi->id_produk = $request->get('produk');
            $komposisi->jumlah = $request->get('jumlah');

            $komposisi->save();
            return Redirect::to('/komposisi/index/'. $id);
        }

    }
    public function delete($id){
        $komposisi_del = Komposisi::findOrfail($id);
        $komposisi_del->delete();
        return response()->json(['status' => 'Data Komposisi Telah Berhasil Di Hapus']);
    }
}
