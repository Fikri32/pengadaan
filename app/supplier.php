<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'nama_supplier','Alamat','fax','no_telp'
    ];
}
