<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\BahanBakuKeluar;

class LaporanKeluarController extends Controller
{
    public function index(){
        $baku_data = BahanBakuKeluar::all();
        // dd($baku_data)
        return view('laporan.keluar',compact('baku_data'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $baku_data = BahanBakuKeluar::select('bahan_bakus.nama','bahan_bakus_keluar.jumlah','bahan_bakus_keluar.tgl_keluar','bahan_bakus_keluar.id_bahan')
                ->join('bahan_bakus','bahan_bakus.id','=','bahan_bakus_keluar.id_bahan')
                ->where('bahan_bakus.nama','like',"%".$cari."%")
                ->orwhere('bahan_bakus_keluar.jumlah','like',"%".$cari."%")
                ->orwhere('bahan_bakus_keluar.tgl_keluar','like',"%".$cari."%")
                ->paginate();
        return view('laporan.keluar',compact('baku_data'));
    }
}
