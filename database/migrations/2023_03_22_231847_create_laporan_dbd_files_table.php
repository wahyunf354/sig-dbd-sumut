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
        Schema::create('laporan_dbd_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("kabkota_id");
            $table->integer("bulan");
            $table->year("tahun");
            $table->string("laporan_file");
            $table->foreign("kabkota_id")->references("id")->on("kabupaten_or_kota_sumut");
            $table->softDeletes();
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
        Schema::dropIfExists('laporan_dbd_files');
    }
};
