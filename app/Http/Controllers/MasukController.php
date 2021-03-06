<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\BahanBaku;
use App\BahanBakuMasuk;
use App\BahanBakuKeluar;
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
        $baku_data = BahanBakuMasuk::orderBy('id_bahan','asc')->orderBy('tgl_masuk','asc')->get();
        // dd($baku_data)
        return view('bahan_masuk.index',compact('baku_data'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $baku_data = BahanBakuMasuk::select('bahan_bakus.nama','suppliers.nama_supplier','bahan_bakus_masuk.jumlah','bahan_bakus_masuk.tgl_masuk','bahan_bakus_masuk.id_bahan','bahan_bakus_masuk.id_supplier')
                ->join('bahan_bakus','bahan_bakus.id','=','bahan_bakus_masuk.id_bahan')
                ->join('suppliers','suppliers.id','=','bahan_bakus_masuk.id_bahan')
                ->where('bahan_bakus.nama','like',"%".$cari."%")
                ->orwhere('suppliers.nama_supplier','like',"%".$cari."%")
                ->orwhere('bahan_bakus_masuk.jumlah','like',"%".$cari."%")
                ->orwhere('bahan_bakus_masuk.tgl_masuk','like',"%".$cari."%")
                ->paginate();
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
                'bahan.required' => 'Bahan Baku Tidak Boleh Kosong',
                'jumlah.required' => 'Jumlah Bahan Baku Tidak Boleh Kosong',
                'tgl_masuk.required' => 'Tanggal Masuk Bahan Baku Tidak Boleh Kosong',
                'supplier.required' => 'Supplier Tidak Boleh Kosong',
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
        $bahan = BahanBaku::all();
        $supplier = supplier::all();
        $masuk = BahanBakuMasuk::where('id',$id)->get();
        return view('bahan_masuk.edit',compact('masuk','bahan','supplier'));
    }

    public function update(Request $request,$id){
        $rules = [
            'bahan' => 'required',
            'jumlah' => 'required',
            'tgl_masuk' => 'required',
            'supplier' => 'required',
        ];
        $pesan = [
            'bahan.required' => 'Bahan Baku Tidak Boleh Kosong',
            'jumlah.required' => 'Jumlah Bahan Baku Tidak Boleh Kosong',
            'tgl_masuk.required' => 'Tanggal Masuk Bahan Baku Tidak Boleh Kosong',
            'supplier.required' => 'Supplier Tidak Boleh Kosong',
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

        if($baku->save()){
            $total_bahan_masuk = BahanBakuMasuk::where('id_bahan',$baku->id_bahan)->sum('jumlah');
            $total_bahan_keluar = BahanBakuKeluar::where('id_bahan',$baku->id_bahan)->sum('jumlah');
            $update_bahan = BahanBaku::find($baku->id_bahan);
            $update_bahan->stok = $total_bahan_masuk - $total_bahan_keluar;
            $update_bahan->update();
            }
            return redirect ('bahanmasuk/index');
        }
    }
    public function delete($id){
        $masuk_del = BahanBakuMasuk::findOrfail($id);
        if($masuk_del->delete())
        {
            $total_bahan_masuk = BahanBakuMasuk::where('id_bahan',$masuk_del->id_bahan)->sum('jumlah');
            $total_bahan_keluar = BahanBakuKeluar::where('id_bahan',$masuk_del->id_bahan)->sum('jumlah');
            $update_bahan = BahanBaku::find($masuk_del->id_bahan);
            $update_bahan->stok = $total_bahan_masuk - $total_bahan_keluar;
            $update_bahan->update();
        }
        return response()->json(['status' => 'Data Bahan Baku Masuk Telah Berhasil Di Hapus']);
    }
}


