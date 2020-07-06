<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\BahanBaku;
use App\BahanBakuKeluar;
use App\BahanBakuMasuk;


class KeluarController extends Controller
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
        $baku_data = BahanBakuKeluar::orderBy('id_bahan','asc')->get();
        // dd($baku_data)
        return view('bahan_keluar.index',compact('baku_data'));
    }

    public function tambah(Request $request){
        if($request->isMethod('get')){
            $bahan = BahanBaku::all();

            return view('bahan_keluar.tambah',compact('bahan'));
        }else{
            $rules = [
                'bahan' => 'required',
                'jumlah' => 'required',
                'tgl_keluar' => 'required',

            ];
            $pesan = [
                'bahan' => 'Bahan Baku Tidak Boleh Kosong',
                'jumlah.required' => 'jumlah Bahan Baku Tidak Boleh Kosong',
                'tgl_keluar.required' => 'tgl_keluar Bahan Baku Tidak Boleh Kosong',

            ];
            $v = Validator :: make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $baku = new BahanBakuKeluar();
                $baku->id_bahan = $request->get('bahan');
                $baku->jumlah = $request->get('jumlah');
                $baku->tgl_keluar = $request->get('tgl_keluar');
                $baku->save();
                $bahanbaku = BahanBaku::find($request->bahan);
                $bahanbaku->stok = $bahanbaku->stok - $request->jumlah;
                $bahanbaku->save();

                return redirect ('bahankeluar/index');
            }
        }
    }
    public function edit(Request $request,$id){
        $bahan = BahanBaku::all();
        $keluar = BahanBakuKeluar::where('id',$id)->get();
        return view('bahan_keluar.edit',compact('keluar','bahan'));
    }

    public function update(Request $request,$id){
        $rules = [
            'bahan' => 'required',

            'jumlah' => 'required',
            'tgl_keluar' => 'required',

        ];
        $pesan = [
            'bahan' => 'Bahan Baku Tidak Boleh Kosong',

            'jumlah.required' => 'jumlah Bahan Baku Tidak Boleh Kosong',
            'tgl_keluar.required' => 'tgl_keluar Bahan Baku Tidak Boleh Kosong',

        ];
        $v = Validator :: make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
            $baku = BahanBakuKeluar::find($id);
            $baku->id_bahan = $request->get('bahan');
            $baku->jumlah = $request->get('jumlah');
            $baku->tgl_keluar = $request->get('tgl_keluar');

            if($baku->update()){
                //untuk table produk
                $total_bahan_masuk = BahanBakuMasuk::where('id_bahan',$baku->id_bahan)->sum('jumlah');
                $total_bahan_keluar = BahanBakuKeluar::where('id_bahan',$baku->id_bahan)->sum('jumlah');
                $update_bahan = BahanBaku::find($baku->id_bahan);
                $update_bahan->stok = $total_bahan_masuk - $total_bahan_keluar;
                $update_bahan->update();
            }

            return redirect ('bahankeluar/index');
        }
    }
    public function delete($id){
        $keluar_del = BahanBakuKeluar::findOrfail($id);
        if($keluar_del->delete()){
            $total_bahan_masuk = BahanBakuMasuk::where('id_bahan',$keluar_del->id_bahan)->sum('jumlah');
            $total_bahan_keluar = BahanBakuKeluar::where('id_bahan',$keluar_del->id_bahan)->sum('jumlah');
            $update_bahan = BahanBaku::find($keluar_del->id_bahan);
            $update_bahan->stok = $total_bahan_masuk - $total_bahan_keluar;
            $update_bahan->update();
        }
        return response()->json(['status' => 'Data Bahan Baku Keluar Telah Berhasil Di Hapus']);
    }
}


