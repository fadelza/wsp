<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasings', function (Blueprint $table) {
            $table->id('id_material');
            $table->bigInteger('id_vendor')->unsigned();
            $table->string('nama_material');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->date('tanggal_order');
            $table->double('total_harga');
            $table->string('status');
            $table->timestamps();
        });
        Schema::table('purchasings', function (Blueprint $table) {
            $table->foreign('id_vendor')->references('id_vendor')->on('vendors')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchasings');
    }
}
