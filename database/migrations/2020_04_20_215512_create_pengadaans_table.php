<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_peramalan');
            $table->unsignedBigInteger('id_supplier');
            $table->Integer('id_bahanbaku');
            $table->date('tanggal');
            $table->Integer('jumlah');
            $table->timestamps();
            $table->foreign('id_supplier')->references('id')->on('suppliers');
            $table->foreign('id_peramalan')->references('id')->on('peramalans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaans');
    }
}
