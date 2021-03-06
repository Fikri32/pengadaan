<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peramalan extends Model
{
     protected $table = 'Peramalans';

    protected $fillable = [
        'id_produk','nama_rencana','jumlah'
    ];

    public function produk(){
        return $this->belongsTo('App\produk','id_produk', 'id');
    }

}
