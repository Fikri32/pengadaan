<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\produk;

class LaporanProduksiController extends Controller
{
    public function index(){

        $produk = produk::all();

        return view('laporan.produk',compact('produk'));
    }
    public function cari(Request $request){
        $cari = $request->cari;

        $produk = DB::table('produks')
                    ->where('nama','like',"%".$cari."%")
                    ->paginate();
        return view('laporan.produk',compact('produk'));
    }
}
