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
}
