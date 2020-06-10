<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanBakuMasuk extends Model
{
    protected $table = 'bahan_bakus_masuk';

    protected $fillable = [
        'id_bahan','id_supplier','jumlah','tgl_masuk'
    ];

    public function bahanbaku(){
        return $this->belongsTo('App\BahanBaku','id_bahan', 'id');
    }

    public function supplier(){
        return $this->belongsTo('App\supplier','id_supplier', 'id');
    }
}
