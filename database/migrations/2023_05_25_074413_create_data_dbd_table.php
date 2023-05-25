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
        Schema::create('data_dbd', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_dbd_file_id');
            $table->unsignedBigInteger('kab_or_kota_id');
            $table->integer('tahun')->nullable();
            $table->integer('bulan')->nullable();
            $table->integer('kasus_lk')->default(0);
            $table->integer('kasus_pr')->default(0);
            $table->integer('kasus_total')->default(0);
            $table->integer('meninggal_lk')->default(0);
            $table->integer('meninggal_pr')->default(0);
            $table->integer('meninggal_total')->default(0);
            $table->integer('abj')->default(0);
            $table->foreign('data_dbd_file_id')->references('id')->on('data_dbd_file');
            $table->foreign('kab_or_kota_id')->references('id')->on('kabupaten_or_kota_sumut');
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
        Schema::dropIfExists('data_dbd');
    }
};
