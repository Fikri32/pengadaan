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
}
