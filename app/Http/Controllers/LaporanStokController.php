<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\BahanBaku;

class LaporanStokController extends Controller
{
    public function index(){
        $baku_data = BahanBaku::all();
        return view('laporan.stok',compact('baku_data'));
    }
}
