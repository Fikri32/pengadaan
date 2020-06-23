<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Peramalan;
use App\penjualan;
use App\produk;


class PeramalanController extends Controller
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
      $peramalan = Peramalan::all();
      return view('peramalan.index',compact('peramalan'));
    }
    public function tambah(Request $request) {
        if($request->isMethod('get')){
            $data = penjualan::getDataPenjualan($request);
            $periode = penjualan::getPeriode($request);
            $produk = produk::all();
            $array = array();

            for($i = 0; $i<count($data); $i++) {
                $array[$i] = intval($data[$i]['jumlah']);

            }


            // dd($array[1]);
            $from = $request->from;
            $to = $request->to;
            $F = 0;


            if($from && $to){
                $F = round((($array[0] * 1) + ($array[1] * 2) + ($array[2] * 3)+ ($array[3] * 4) + ($array[4] * 5) + ($array[5] * 6))/21);

            }

            $data = [
                'periode' => $periode,
                'array'   => $array
            ];

            // dd($data['array']);


            return view('peramalan.ramal',compact('produk','F','array','periode','data'));

        }else{
            $rules = [
                'nama'  => 'required',
                'jumlah' => 'required',
            ];
            $pesan = [
                'nama' => 'Bahan Baku Tidak Boleh Kosong',
                'jumlah' => 'Jumlah Tidak Boleh Kosong',
            ];
            $v = Validator :: make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $peramalan = new Peramalan();
                $peramalan->id_produk = $request->input('produk');
                $peramalan->nama_rencana = $request->get('nama');
                $peramalan->jumlah = $request->get('jumlah');
                // dd($pengadaan);

                $peramalan->save();
                return redirect ('peramalan/index');
            }
        }
    }
}

