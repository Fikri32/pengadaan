<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_bakus';

    protected $fillable = [
        'nama','stok','satuan'
    ];

    public function komposisi(){
        return $this->hasOne('App\Komposisi','id_bahanbaku', 'id');
    }
}
