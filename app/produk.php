<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produks';

    protected $fillable = [
        'nama','stok','harga'
    ];
    public function komposisi(){
        return $this->hasMany('App\Komposisi','id_produk', 'id');
    }
    public function produkmasuk(){
        return $this->hasMany('App\ProdukMasuk','id_produk', 'id');
    }




}
