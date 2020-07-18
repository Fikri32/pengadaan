<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use App\Peramalan;
use App\penjualan;
use App\produk;
use Carbon\Carbon;


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
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $peramalan = peramalan::select('produks.nama','peramalans.jumlah','peramalans.nama_rencana','peramalans.id_produk')
                ->join('produks','produks.id','=','peramalans.id_produk')
                ->where('produks.nama','like',"%".$cari."%")
                ->orwhere('peramalans.jumlah','like',"%".$cari."%")
                ->orwhere('peramalans.nama_rencana','like',"%".$cari."%")
                ->paginate();
        return view('peramalan.index',compact('peramalan'));
    }

    public function tambah(Request $request) {
        if($request->isMethod('get')){
            $now = Carbon::now()->toDateString();

            $periode = penjualan::getPeriode($request);
            $produk = produk::all();
            $produk_id = $request->get('produk');
            $name_prod = produk::select('nama')
                        ->where('produks.id', $produk_id)
                        ->pluck('nama');
            $nama = $request->input('target');
            $periode = array();
            $array = array();

            $target = $request->target;

            $F = 0;
            $produksi = 0;
            $kerja = 20;
            $d = 0;
            $sd = 0;
            $sl = 0;
            $z = 1.28;
            $stok = 0;
            $sdl = 0;

            if( $target)
            {
                $produk_id = $request->input('produk');
                $dateMonthArray = explode('-', $request->target);
                $month = $dateMonthArray[1];
                $year = $dateMonthArray[0];
                $metode = 6;
                $dari = number_format(Carbon::createFromDate($year, $month)->startOfMonth()->subMonths($metode)->format('n'));
                $sampai = number_format(Carbon::createFromDate($year, $month)->endOfMonth()->subMonths(1)->format('n'));

                $bln = 1;


                for($i= $dari; $i <= $sampai; $i++)
                {
                    $bulan = Carbon::createFromDate($year, $month)->startOfMonth()->subMonths($bln);
                    $penjualan = penjualan::
                    selectRaw('DATE_FORMAT(penjualans.tanggal, "%Y-%m") as periode,penjualans.id_produk,penjualans.jumlah')
                    ->join('produks', 'produks.id', '=', 'penjualans.id_produk')
                    ->where('produks.id', $produk_id)
                    ->whereMonth('penjualans.tanggal', Carbon::createFromDate($year, $month)->startOfMonth()->subMonths($bln)->format('m'))
                    ->orderBy('penjualans.id','asc')
                    ->first();
                    // dd($penjualan);
                    if($penjualan)
                    {
                        // $sum_penjualan += $penjualan;
                        $array[] = $penjualan->jumlah;
                        // $total_index += $kurang;
                        // echo $data." <br>";
                        $periode[] = $bulan->format('F Y');
                    }else{
                        return response()->json([
                            'fail' => true,
                            'errors' => 'Data Penjualan Sebelumnya Kurang Dari '.$metode.' Bulan',
                            'tipe' => 'data'
                        ]);
                        die;
                    }
                    $bln++;
                }
                $akhir = produk::findOrFail($request->produk);
                $stok = $akhir->stok;
                $F = round((($array[0] * 6) + ($array[1] * 5) + ($array[2] * 4)+ ($array[3] * 3) + ($array[4] * 2) + ($array[5] * 1))/21);
                $d = $F/$kerja;
                $sd = $d/10;
                $sl = 1/10;
                $sdl = (pow($d,2) * pow($sl,2)) + (1 * pow($sd,2));
                $sdl = (sqrt($sdl)) * $z;
                $sdl = round($sdl);

                $produksi = $F + $sdl - $stok;

            }

            $data = [
                'array'   => $array,
                'periode' => $periode
            ];
            // dd($data);
            return view('peramalan.ramal',compact('produk','produksi','array','periode','data','stok','sdl','F','now','produk_id','nama','name_prod'));
        }else{
            $rules = [
                'nama'  => 'required',
                'jumlah' => 'required',
            ];
            $pesan = [
                'nama.required' => 'Nama Rencana Tidak Boleh Kosong',
                'jumlah.required' => 'Jumlah Pengadaan Tidak Boleh Kosong',
            ];
            $v = Validator :: make($request->all(),$rules,$pesan);
            if($v->fails()){
                return back()->withInput()->withErrors($v);
            }else{
                $peramalan = new Peramalan();
                $peramalan->id_produk = $request->get('produk_id');
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
            $now = Carbon::now()->toDateString();
            $periode = penjualan::getPeriode($request);
            $produk = produk::all();
            $ramal = Peramalan::where('id',$id)->get();
            $produk_id = $request->input('produk');
            $periode = array();
            $array = array();

            $target = $request->target;

            $F = 0;
            $produksi = 0;
            $kerja = 20;
            $d = 0;
            $sd = 0;
            $sl = 0;
            $z = 1.28;
            $stok = 0;
            $sdl = 0;

            if( $target)
            {
                $produk_id = $request->input('produk');
                $dateMonthArray = explode('-', $request->target);
                $month = $dateMonthArray[1];
                $year = $dateMonthArray[0];
                $metode = 6;
                $dari = number_format(Carbon::createFromDate($year, $month)->startOfMonth()->subMonths($metode)->format('n'));
                $sampai = number_format(Carbon::createFromDate($year, $month)->endOfMonth()->subMonths(1)->format('n'));

                $bln = 1;

                for($i= $dari; $i <= $sampai; $i++)
                {
                    $bulan = Carbon::createFromDate($year, $month)->startOfMonth()->subMonths($bln);
                    $penjualan = penjualan::
                    selectRaw('DATE_FORMAT(penjualans.tanggal, "%Y-%m") as periode,penjualans.id_produk,penjualans.jumlah')
                    ->join('produks', 'produks.id', '=', 'penjualans.id_produk')
                    ->where('produks.id', $produk_id)
                    ->whereMonth('penjualans.tanggal', Carbon::createFromDate($year, $month)->startOfMonth()->subMonths($bln)->format('m'))
                    ->orderBy('penjualans.id','asc')
                    ->first();
                    // dd($penjualan);
                    if($penjualan)
                    {
                        // $sum_penjualan += $penjualan;
                        $array[] = $penjualan->jumlah;
                        // $total_index += $kurang;
                        // echo $data." <br>";
                        $periode[] = $bulan->format('F Y');
                    }else{
                        return response()->json([
                            'fail' => true,
                            'errors' => 'Data Penjualan Sebelumnya Kurang Dari '.$metode.' Bulan',
                            'tipe' => 'data'
                        ]);
                        die;
                    }
                    $bln++;
                }
                $akhir = produk::findOrFail($request->produk);
                $stok = $akhir->stok;
                $total_bulan =
                $F = round((($array[0] * 6) + ($array[1] * 5) + ($array[2] * 4)+ ($array[3] * 3) + ($array[4] * 2) + ($array[5] * 1))/21);
                $d = $F/$kerja;
                $sd = $d/10;
                $sl = 1/10;
                $sdl = (pow($d,2) * pow($sl,2)) + (1 * pow($sd,2));
                $sdl = (sqrt($sdl)) * $z;
                $sdl = round($sdl);

                $produksi = $F + $sdl - $stok;

            }

            $data = [
                'array'   => $array,
                'periode' => $periode
            ];
            return view('peramalan.edit',compact('produk','produksi','array','periode','data','stok','sdl','F','now','ramal','produk_id'));
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
                $peramalan->id_produk = $request->get('produk_id');
                $peramalan->nama_rencana = $request->get('nama');
                $peramalan->jumlah = $request->get('jumlah');
                // dd($pengadaan);

                $peramalan->save();
                return redirect ('peramalan/index');
            }
        }
    }

    public function delete($id){
        $peramalan = Peramalan::findOrFail($id);
        $peramalan->delete();
        return response()->json(['status' => 'Data Peramalan Telah Berhasil Di hapus']);
    }

}

