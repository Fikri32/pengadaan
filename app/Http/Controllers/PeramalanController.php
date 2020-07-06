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
            // dd($produk);
            $array = array();
            // $session = $request->session()->put('produk',$produk_id);
            // dd($session);


            // $hasil = intval($akhir);
            for($i = 0; $i<count($data); $i++) {
                $array[$i] = intval($data[$i]['jumlah']);

            }
            // dd($array[1]);
            $from = $request->from;
            $to = $request->to;
            $F = 0;
            $produksi = 0;
            $kerja = 20;
            $d = 0;
            $sd = 0;
            $sl = 0;
            $z = 1.28;

            if($from && $to)
            {
                $akhir = produk::findOrFail($request->produk);
                $stok = $akhir->stok;
                // dd($stok);

                // $hasil = intval($akhir['stok']);

                $F = round((($array[0] * 1) + ($array[1] * 2) + ($array[2] * 3)+ ($array[3] * 4) + ($array[4] * 5) + ($array[5] * 6))/21);
                $d = $F/$kerja;
                $sd = $d/10;
                $sl = 1/10;
                $sdl = (pow($d,2) * pow($sl,2)) + (1 * pow($sd,2));
                $sdl = (sqrt($sdl)) * $z;
                $sdl = round($sdl);
                // dd($sdl);
                $produksi = $F + $sdl - $stok;
                // dd($hasil);
            }

            $data = [
                'periode' => $periode,
                'array'   => $array
            ];
            // dd($data);
            return view('peramalan.ramal',compact('produk','produksi','array','periode','data'));
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
                $peramalan->id_produk = Input::get('produk');
                $peramalan->nama_rencana = $request->get('nama');
                $peramalan->jumlah = $request->get('jumlah');
                // dd($pengadaan);

                $peramalan->save();
                return redirect ('peramalan/index');
            }
        }
    }
    public function update(Request $request,$id) {
         if($request->isMethod('get')){
            $data = penjualan::getDataPenjualan($request);
            $periode = penjualan::getPeriode($request);
            $ramal = Peramalan::where('id',$id)->get();
            // dd($ramal);
            $produk = produk::all();
            $array = array();

            $akhir = produk::select('produks.stok')
                    ->first();

                    $hasil = intval($akhir['stok']);

            // $hasil = intval($akhir);
            for($i = 0; $i<count($data); $i++) {
                $array[$i] = intval($data[$i]['jumlah']);

            }
            // dd($array[1]);
            $from = $request->from;
            $to = $request->to;
            $F = 0;
            $produksi = 0;
            $kerja = 20;
            $d = 0;
            $sd = 0;
            $sl = 0;
            $z = 1.28;

            if($from && $to)
            {
                $akhir = produk::findOrFail($request->produk);
                $stok = $akhir->stok;

                $F = round((($array[0] * 1) + ($array[1] * 2) + ($array[2] * 3)+ ($array[3] * 4) + ($array[4] * 5) + ($array[5] * 6))/21);
                $d = $F/$kerja;
                $sd = $d/10;
                $sl = 1/10;
                $sdl = (pow($d,2) * pow($sl,2)) + (1 * pow($sd,2));
                $sdl = (sqrt($sdl)) * $z;
                $sdl = round($sdl);
                // dd($sdl);
                $produksi = $F + $sdl - $stok;
                // dd($hasil);
            }

            $data = [
                'periode' => $periode,
                'array'   => $array
            ];
            return view('peramalan.edit',compact('produk','produksi','array','periode','data','ramal'));
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
                $peramalan = Peramalan::findOrFail($id);
                $peramalan->id_produk = $request->input('produk');
                $peramalan->nama_rencana = $request->get('nama');
                $peramalan->jumlah = $request->get('jumlah');
                // dd($pengadaan);

                $peramalan->save();
                return redirect ('peramalan/index');
            }
        }
    }
    public function getProduk(Request $request)
    {
        // dd($request->all());
        $produk = produk::find($request->produk);
        return response()->json([
            // 'produk'=> $produk->id,
        ]);
    }
}

