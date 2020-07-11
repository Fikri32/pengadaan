<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\ProdukMasuk;
use App\penjualan;
use App\produk;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    public function index(){
        $jual = Penjualan::orderBy('id_produk','asc')->get();
        return view('laporan.penjualan',compact('jual'));
    }
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $jual = penjualan::select('produks.nama','penjualans.jumlah','penjualans.tanggal','penjualans.id_produk')
                ->join('produks','produks.id','=','penjualans.id_produk')
                ->where('produks.nama','like',"%".$cari."%")
                ->orwhere('penjualans.jumlah','like',"%".$cari."%")
                ->orwhere('penjualans.tanggal','like',"%".$cari."%")
                ->paginate();
        return view('laporan.penjualan',compact('jual'));
    }
}
