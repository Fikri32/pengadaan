<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\penjualan;
use App\produk;
use App\BahanBaku;
use App\BahanBakuMasuk;
use App\BahanBakuKeluar;
use DB;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
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
    public function index()
    {

        $penjualan = penjualan::select('penjualans.id_produk,penjualans.jumlah')
        ->join('produks','produks.id','=','penjualans.id_produk')
        ->where('produks.nama','=','Polyester Chips')
        ->sum('penjualans.jumlah');

        $Fiber = penjualan::select('penjualans.id_produk,penjualans.jumlah')
        ->join('produks','produks.id','=','penjualans.id_produk')
        ->where('produks.nama','=','Polyester Fiber')
        ->sum('penjualans.jumlah');

        // dd($penjualan);
        $produk    = produk::all();
        $bahan     = BahanBaku::all();
        // dd($produk);
        return view('beranda', compact('penjualan','produk','Fiber','bahan'));
    }
}
