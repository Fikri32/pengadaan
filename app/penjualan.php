<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    protected $table = 'penjualans';

    protected $fillable = [
        'id_produk','tanggal','jumlah'
    ];

    public function produk(){
        return $this->belongsTo('App\produk','id_produk', 'id');
    }

    public static function getPeriode($request)
    {
        $array= array();
        $month = $request->from;
        $i = 0;
        while(date('Y-m', strtotime($month)) <= date('Y-m', strtotime($request->to))) {
            $array[$i] = $month;
            $month = date('Y-m', strtotime("+1 month", strtotime(date($month))));
            $i++;
        }

        return $array;
    }
    public static function getTotal($periode, $data)
    {
        $array = array();
        for($i=0; $i<count($periode); $i++) {
            for($j=0; $j<count($data); $j++) {
                if($periode[$i] == $data[$j]['periode']){
                    $array[$i] = intval($data[$j]['jumlah']);
                    break;
                }else{
                    $array[$i] = 0;

                }
            }
        }
        return $array;
    }

    public static function getDataPenjualan($request)
    {
        $request->session()->put('key', 'value');
        $produk_id = $request->input('produk');
        $session = $request->session()->put('produk',$produk_id);
        // dd($session);
        $from = $request->from;
        $to = $request->to;

        $data = penjualan::selectRaw('DATE_FORMAT(penjualans.tanggal, "%Y-%m") as periode,penjualans.id_produk,penjualans.jumlah')
            ->join('produks', 'produks.id', '=', 'penjualans.id_produk')
            ->where('produks.id', $produk_id)
            ->whereRaw("DATE_FORMAT(penjualans.tanggal, '%Y-%m') >= '$from' AND DATE_FORMAT(penjualans.tanggal, '%Y-%m') <= '$to'")
            ->get();

        return $data;
    }
    public static function getAllDataPenjualan()
    {
        $array = [];
        for($i = 0; $i < 12; $i++) {
            $array[$i] = '';
        }
        // $array[11] = '2018-02'; // diganti get month bulan sekarang
        $array[11] = date('Y-m');
        $i = 10;
        while($i >= 0) {
            $array[$i] = date('Y-m', strtotime("-1 month", strtotime(date($array[$i + 1]))));
            $i--;
        }

        $data = penjualan::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as periode')
            ->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') >= '$array[0]' AND DATE_FORMAT(tanggal, '%Y-%m') <= '$array[11]'")
            ->groupBy('periode')
            ->get();

        return ['periode' => $array, 'data' => $data];
    }

}
