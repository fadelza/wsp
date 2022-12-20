<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id('id_sales');
            $table->string('kode_order');
            $table->bigInteger('id_kontak')->unsigned();
            $table->bigInteger('id_produk')->unsigned();
            $table->integer('value');
            $table->date('tanggal_order');
            $table->double('total_harga');
            $table->string('status');
            $table->timestamps();
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
