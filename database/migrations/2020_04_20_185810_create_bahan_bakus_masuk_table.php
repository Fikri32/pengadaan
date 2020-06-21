<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahanBakusMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_bakus_masuk', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_bahan');
            $table->unsignedBigInteger('id_supplier');
            $table->Integer('jumlah');
            $table->date('tgl_masuk');
            $table->timestamps();
            $table->foreign('id_supplier')->references('id')->on('suppliers');
            $table->foreign('id_bahan')->references('id')->on('bahan_bakus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahan_bakus');
    }
}
