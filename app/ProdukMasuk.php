<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukMasuk extends Model
{
    protected $table = 'produks_masuk';

    protected $fillable = [
        'id_produk','jumlah','tanggal'
    ];
    public function produk()
    {
        return $this->belongsTo('App\produk','id_produk', 'id');
    }
}
