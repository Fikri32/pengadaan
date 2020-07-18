<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Peramalan;
use App\pengadaan;
use App\supplier;
use App\BahanBaku;
use App\Komposisi;
use Carbon\Carbon;

class PengadaanController extends Controller
{
    public function index()
    {
        $supplier = supplier::all();
        $bahan = BahanBaku::all();
        $ramal = Peramalan::all();

        $pengadaan = pengadaan::orderBy('id_peramalan', 'asc')

                    ->get();

        return view('pengadaan.index',compact('pengadaan'));
    }
    public function tambah(Request $request){
        if($request->isMethod('get')){
            // $produk = produk::all();

            $supplier = supplier::all();
            $bahan = BahanBaku::all();
            $ramal = Peramalan::all();
            $now = Carbon::now()->toDateString();


        return view('pengadaan.tambah',compact('supplier','bahan','ramal','now'));
        }else{
            $rules = [
                'bahan'  => 'required',
                'jumlah' => 'required',
            ];
            $pesan = [
                'bahan' => 'Bahan Baku Tidak Boleh Kosong',
                'jumlah' => 'Jumlah Tidak Boleh Kosong',
            ];
            $v = Validator :: make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $pengadaan = new pengadaan();
                $pengadaan->id_bahanbaku = $request->get('baku');
                $pengadaan->id_peramalan = $request->get('bahan');
                $pengadaan->id_supplier = $request->get('supplier');
                $pengadaan->jumlah = $request->get('beli');
                $pengadaan->tanggal = $request->get('tanggal');
                // dd($pengadaan);
                $pengadaan->save();
                return redirect ('pengadaan/index');
            }
        }
    }

    public function edit(Request $request,$id)
    {
        $pengadaan = pengadaan::where('id',$id)->get();
        $supplier = supplier::all();
        $bahan = BahanBaku::all();
        $ramal = Peramalan::all();

        return view('pengadaan.edit',compact('pengadaan','supplier','bahan','ramal'));
    }

    public function update(Request $request,$id)
    {

        $rules = [
            'bahan'  => 'required',
            'jumlah' => 'required',
        ];
        $pesan = [
            'bahan' => 'Bahan Baku Tidak Boleh Kosong',
            'jumlah' => 'Jumlah Tidak Boleh Kosong',
        ];
        $v = Validator :: make($request->all(),$rules,$pesan);
        if($v->fails()){
            return back()->withInput()->withErrors($v);
        }else{
            $pengadaan = pengadaan::find($id);
            $pengadaan->id_bahanbaku = $request->get('baku');
            $pengadaan->id_peramalan = $request->get('bahan');
            $pengadaan->id_supplier = $request->get('supplier');
            $pengadaan->jumlah = $request->get('beli');
            $pengadaan->tanggal = $request->get('tanggal');
            // dd($pengadaan);
            $pengadaan->save();
            return redirect ('pengadaan/index');
        }
    }
    public function delete($id)
    {
        $pengadaan = pengadaan::findOrfail($id);
        $pengadaan->delete();
        return response()->json(['status' => 'Data Penjualan Telah Berhasil Di hapus']);
    }


    public function getJumlah(Request $request)
    {
        // dd($request->all());
        $pengadaan = Peramalan::find($request->bahan_id);
        return response()->json([
            'jumlah' => $pengadaan->jumlah,
        ]);
    }

    public function getTotal(Request $request)
    {
        // dd($request->all());
        $bahanBaku = BahanBaku::find($request->bahan_id);
        $peramalan = Peramalan::find($request->bahan_id);




        return response()->json([
            'jumlah' => $bahanBaku->komposisi->jumlah,
            'stok'   => $bahanBaku->stok,

        ]);
    }

}
