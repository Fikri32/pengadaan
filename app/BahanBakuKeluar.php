<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanBakuKeluar extends Model
{
    protected $table = 'bahan_bakus_keluar';

    protected $fillable = [
        'id_bahan','jumlah','tgl_keluar'
    ];
    public function bahanbaku(){
        return $this->belongsTo('App\BahanBaku','id_bahan', 'id');
    }
}
