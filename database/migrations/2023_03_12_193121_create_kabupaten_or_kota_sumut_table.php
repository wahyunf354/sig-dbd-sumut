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
        Schema::create('kabupaten_or_kota_sumut', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('luas');
            $table->integer('jmlpddk');
            $table->string('file_geojson');
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
        Schema::dropIfExists('kabupaten_or_kota_sumut');
    }
};
