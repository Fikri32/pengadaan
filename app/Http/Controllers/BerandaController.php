<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Role::create(['name'=>'operator']);

        $masuk = BahanBakuMasuk::select(DB::raw('
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=1)AND (YEAR(tanggal)=2019) )),0) AS "Januari",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=2)AND (YEAR(tanggal)=2019) )),0) AS "Februari",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=3)AND (YEAR(tanggal)=2019) )),0) AS "Maret",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=4)AND (YEAR(tanggal)=2019) )),0) AS "April",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=5)AND (YEAR(tanggal)=2019) )),0) AS "Mei",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=6)AND (YEAR(tanggal)=2019) )),0) AS "Juni",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=7)AND (YEAR(tanggal)=2019) )),0) AS "Juli",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=8)AND (YEAR(tanggal)=2019) )),0) AS "Agustus",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=9)AND (YEAR(tanggal)=2019) )),0) AS "September",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=10)AND (YEAR(tanggal)=2019) )),0) AS "Oktober",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=11)AND (YEAR(tanggal)=2019) )),0) AS "November",
            ifnull( (SELECT count(id) FROM (bahan_bakus_masuk)WHERE((Month(tanggal)=12)AND (YEAR(tanggal)=2019) )),0) AS "Desember", YEAR(tanggal) AS tahun'))
            ->groupby('tahun')->get();

        $keluar = BahanBakuKeluar::select(DB::raw('
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=1)AND (YEAR(tanggal)=2019) )),0) AS "Januari",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=2)AND (YEAR(tanggal)=2019) )),0) AS "Februari",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=3)AND (YEAR(tanggal)=2019) )),0) AS "Maret",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=4)AND (YEAR(tanggal)=2019) )),0) AS "April",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=5)AND (YEAR(tanggal)=2019) )),0) AS "Mei",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=6)AND (YEAR(tanggal)=2019) )),0) AS "Juni",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=7)AND (YEAR(tanggal)=2019) )),0) AS "Juli",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=8)AND (YEAR(tanggal)=2019) )),0) AS "Agustus",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=9)AND (YEAR(tanggal)=2019) )),0) AS "September",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=10)AND (YEAR(tanggal)=2019) )),0) AS "Oktober",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=11)AND (YEAR(tanggal)=2019) )),0) AS "November",
            ifnull( (SELECT count(id) FROM (bahan_bakus_keluar)WHERE((Month(tanggal)=12)AND (YEAR(tanggal)=2019) )),0) AS "Desember", YEAR(tanggal) AS tahun'))
            ->groupby('tahun')->get();

        $chart_masuk = array();
        foreach($masuk as $row){
                $chart_masuk[]= $row->Januari;
                $chart_masuk[]= $row->Februari;
                $chart_masuk[]= $row->Maret;
                $chart_masuk[]= $row->April;
                $chart_masuk[]= $row->Mei;
                $chart_masuk[]= $row->Juni;
                $chart_masuk[]= $row->Juli;
                $chart_masuk[]= $row->Agustus;
                $chart_masuk[]= $row->September;
                $chart_masuk[]= $row->Oktober;
                $chart_masuk[]= $row->November;
                $chart_masuk[]= $row->Desember;
        }

        $chart_keluar = array();
        foreach($keluar as $row){
            $chart_keluar[]= $row->Januari;
            $chart_keluar[]= $row->Februari;
            $chart_keluar[]= $row->Maret;
            $chart_keluar[]= $row->April;
            $chart_keluar[]= $row->Mei;
            $chart_keluar[]= $row->Juni;
            $chart_keluar[]= $row->Juli;
            $chart_keluar[]= $row->Agustus;
            $chart_keluar[]= $row->September;
            $chart_keluar[]= $row->Oktober;
            $chart_keluar[]= $row->November;
            $chart_keluar[]= $row->Desember;
    }

        return view('beranda', compact('chart_masuk', 'chart_keluar'));
    }
}


