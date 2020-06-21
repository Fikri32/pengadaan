<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\BahanBaku;

class BahanBakuController extends Controller
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
        $baku_data = BahanBaku::all();
        return view('bahan_baku.stok',compact('baku_data'));
    }
    public function tambah(Request $request){
        if($request->isMethod('get')){
        return view('bahan_baku.tambah');
        }else{
            $rules = [
                'nama' => 'required',

                'satuan' => 'required',
            ];
            $pesan = [
                'nama.required' => 'Nama Bahan Baku Tidak Boleh Kosong',

                'Satuan.required' => 'Satuan Bahan Baku Tidak Boleh Kosong',
            ];
            $v = Validator :: make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $baku = new BahanBaku();
                $baku->nama = $request->get('nama');

                $baku->satuan = $request->get('satuan');
                $baku->save();
                return redirect ('bahanbaku/index');
            }
        }
    }

    public function edit(Request $request,$id){
        $baku = BahanBaku::where('id',$id)->get();
        return view('bahan_baku.edit',compact('baku'));
    }

    public function update(Request $request,$id){
        $rules = [
            'nama' => 'required',
            'stok' => 'required',
            'satuan' => 'required',
        ];
        $pesan = [
            'nama.required' => 'Nama Bahan Baku Tidak Boleh Kosong',
            'stok.required' => 'stok Bahan Baku Tidak Boleh Kosong',
            'Satuan.required' => 'Satuan Bahan Baku Tidak Boleh Kosong',
        ];
        $v = Validator :: make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
            $baku = BahanBaku::find($id);
            $baku->nama = $request->get('nama');
            $baku->stok = $request->get('stok');
            $baku->satuan = $request->get('satuan');
            $baku->save();
            return redirect ('bahanbaku/index');
        }
    }
    public function delete($id){
        DB::table('bahan_bakus')->where('id',$id)->delete();
        return back();
    }


}
