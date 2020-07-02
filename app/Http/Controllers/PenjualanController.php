<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
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
        $jual = Penjualan::all();
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

                $jual->save();
                $produk = produk::find($request->produk);
                $produk->stok = $produk->stok - $request->jumlah;
                $produk->save();
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
            $jual->tanggal = $request->get('tanggal');
            $jual->jumlah = $request->get('jumlah');

            $jual->save();
            return redirect ('penjualan/index');
        }
    }
    public function delete($id){
        $penjualan_del = penjualan::findOrfail($id);
        $penjualan_del->delete();
        return response()->json(['status' => 'Data Penjualan Telah Berhasil Di hapus']);
    }


}
