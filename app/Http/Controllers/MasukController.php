<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\BahanBaku;
use App\BahanBakuMasuk;
use App\Supplier;


class MasukController extends Controller
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
        $baku_data = BahanBakuMasuk::all();
        // dd($baku_data)
        return view('bahan_masuk.index',compact('baku_data'));
    }

    public function tambah(Request $request){
        if($request->isMethod('get')){
            $bahan = BahanBaku::all();
            $supplier = supplier::all();
            return view('bahan_masuk.tambah',compact('bahan','supplier'));
        }else{
            $rules = [
                'bahan' => 'required',
                'jumlah' => 'required',
                'tgl_masuk' => 'required',
                'supplier' => 'required',
            ];
            $pesan = [
                'bahan' => 'Bahan Baku Tidak Boleh Kosong',
                'jumlah.required' => 'jumlah Bahan Baku Tidak Boleh Kosong',
                'tgl_masuk.required' => 'tgl_masuk Bahan Baku Tidak Boleh Kosong',
                'supplier' => 'Supplier Tidak Boleh Kosong',
            ];
            $v = Validator :: make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $baku = new BahanBakuMasuk();
                $baku->id_bahan = $request->get('bahan');
                $baku->id_supplier = $request->get('supplier');
                $baku->jumlah = $request->get('jumlah');
                $baku->tgl_masuk = $request->get('tgl_masuk');
                $baku->save();
                $bahanbaku = BahanBaku::find($request->bahan);
                $bahanbaku->stok = $bahanbaku->stok + $request->jumlah;
                $bahanbaku->save();

                return redirect ('bahanmasuk/index');
            }
        }
    }
    public function edit(Request $request,$id){
        $keluar = BahanBakuMasuk::where('id',$id)->get();
        return view('bahan_masuk.edit',compact('keluar'));
    }

    public function update(Request $request,$id){
        $rules = [
            'bahan' => 'required',
            'jumlah' => 'required',
            'tgl_masuk' => 'required',
            'supplier' => 'required',
        ];
        $pesan = [
            'bahan' => 'Bahan Baku Tidak Boleh Kosong',
            'jumlah.required' => 'jumlah Bahan Baku Tidak Boleh Kosong',
            'tgl_masuk.required' => 'tgl_masuk Bahan Baku Tidak Boleh Kosong',
            'supplier' => 'Supplier Tidak Boleh Kosong',
        ];
        $v = Validator :: make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
            $baku = BahanBakuMasuk::find($id);
            $baku->id_bahan = $request->get('bahan');
            $baku->id_supplier = $request->get('supplier');
            $baku->jumlah = $request->get('jumlah');
            $baku->tgl_masuk = $request->get('tgl_masuk');
            $baku->save();

            $bahanbaku = BahanBaku::find($request->bahan);
            $bahanbaku->stok = $bahanbaku->stok - $request->jumlah;
            $bahanbaku->save();

            return redirect ('bahanmasuk/index');
        }
    }
    public function delete($id){
        DB::table('bahan_bakus_masuk')->where('id',$id)->delete();
        return back();
    }
}


