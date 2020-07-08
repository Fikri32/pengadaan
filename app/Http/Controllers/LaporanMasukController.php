<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\BahanBakuMasuk;


class LaporanMasukController extends Controller
{
    public function index(){
        $baku_data = BahanBakuMasuk::all();
        // dd($baku_data)
        return view('laporan.masuk',compact('baku_data'));
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
        return view('laporan.masuk',compact('baku_data'));
    }
}
