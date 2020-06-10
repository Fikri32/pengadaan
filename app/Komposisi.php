<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komposisi extends Model
{
    protected $table = 'komposisis';

    protected $fillable = [
        'id_bahanbaku','id_produk','jumlah'
    ];
    public function bahanbaku(){
        return $this->belongsTo('App\BahanBaku','id_bahanbaku', 'id');
    }
    public function produk(){
        return $this->belongsTo('App\produk','id_produk', 'id');
    }

}
