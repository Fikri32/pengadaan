<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\produk;

class ProdukController extends Controller
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

        $produk = produk::all();

        return view('produk.index',compact('produk'));
    }
    public function cari(Request $request){
        $cari = $request->cari;

        $produk = DB::table('produks')
                    ->where('nama','like',"%".$cari."%")
                    ->paginate();
        return view('produk.index',compact('produk'));
    }


    public function tambah(Request $request){
        if($request->isMethod('get')){

            return view('produk.tambah');
        }else{
            $rules = [
                'nama' => 'required',
                'harga' => 'required'


            ];

            $pesan = [
                'nama.required' => 'Nama Produk Tidak Boleh Kosong',
                'harga.required' => 'Harga Produk Tidak Boleh Kosong'


            ];

            $v = Validator::make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
               $produk = new produk();
               $produk->nama = $request->get('nama');
               $produk->harga = $request->get('harga');
               $produk->save();
               alert()->success('Produk Berhasil Di tambahkan','');


            }
            return redirect('produk/index');
        }
    }
    public function edit(Request $request,$id){
        $produk = produk::where('id',$id)->get();
        return view('produk.edit',compact('produk'));
    }

    public function update(Request $request,$id){
        $rules = [
            'nama' => 'required',
            'harga' => 'required'


        ];

        $pesan = [
            'nama.required' => 'Nama Produk Tidak Boleh Kosong',
            'harga.required' => 'Harga Produk Tidak Boleh Kosong'


        ];

        $v = Validator::make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
           $produk = produk::find($id);
           $produk->nama = $request->get('nama');
           $produk->harga = $request->get('harga');
           $produk->save();


        }
        Alert::success('Success Title', 'Success Message');

        return redirect('produk/index');
    }

    public function delete($id){
        $produk_del = produk::findOrfail($id);
        $produk_del->delete();
        return response()->json(['status' => 'Data Produk Telah Berhasil Di hapus']);
    }

}

