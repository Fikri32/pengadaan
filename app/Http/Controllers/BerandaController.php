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

class BerandaController extends Controller
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
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $penjualan = penjualan::count();

        return view('beranda', compact('penjualan','produk'));
    }



}


