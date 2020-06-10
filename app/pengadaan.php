<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengadaan extends Model
{
    protected $table = 'pengadaans';

    protected $fillable = [
        'id_bahanbaku','id_supplier','jumlah','tanggal'
    ];
    public function bahanbaku(){
        return $this->belongsTo('App\BahanBaku','id_bahan', 'id');
    }

    public function supplier(){
        return $this->belongsTo('App\supplier','id_supplier', 'id');
    }

    public function peramalan(){
        return $this->belongsTo('App\Peramalan','id_peramalan', 'id');
    }

}
