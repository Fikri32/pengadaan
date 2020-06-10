<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
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

        $produk_data = produk::all();

        return view('produk.index',compact('produk_data'));
    }


    public function tambah(Request $request){
        if($request->isMethod('get')){
            return view('produk.tambah');
        }else{
            $rules = [
                'nama' => 'required',


            ];

            $pesan = [
                'nama' => 'required',


            ];

            $v = Validator::make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
               $produk = new produk();
               $produk->nama = $request->get('nama');
               $produk->save();
               return redirect('produk/index');
            }
        }
    }
    public function edit(Request $request,$id){
        $produk = produk::where('id',$id)->get();
        return view('produk.edit',compact('produk'));
    }

    public function update(Request $request,$id){
        $rules = [
            'nama' => 'required',


        ];

        $pesan = [
            'nama' => 'required',


        ];

        $v = Validator::make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
           $produk = produk::find($id);
           $produk->nama = $request->get('nama');
           $produk->save();
           return redirect('produk/index');
        }
    }

    public function delete($id){
        DB::table('produks')->where('id',$id)->delete();
        return back();
    }

}

