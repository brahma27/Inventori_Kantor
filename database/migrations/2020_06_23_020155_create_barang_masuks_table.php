<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Jumlah');
            $table->date('Tanggal_Masuk');
            $table->timestamps();
        });
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->unsignedInteger('id_barang');
            $table->unsignedInteger('id_admin');
        
            $table->foreign('id_barang')->references('id')->on('barangs');
            $table->foreign('id_admin')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_masuks');
    }
}
