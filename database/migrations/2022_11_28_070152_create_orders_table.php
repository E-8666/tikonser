<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            //'kode_reedem', 'id_customer', 'id_tiket', 'status', 'harga'
            $table->id();
            $table->string('kode_reedem');
            $table->integer('id_customer');
            $table->integer('id_tiket');
            $table->string('status');
            $table->integer('jumlah_tiket');
            $table->integer('jumlah_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
