<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama','stok','harga'
    ];

    public function produkmasuk(){
        return $this->hasMany('App\ProdukMasuk','id_produk', 'id');
    }




}
