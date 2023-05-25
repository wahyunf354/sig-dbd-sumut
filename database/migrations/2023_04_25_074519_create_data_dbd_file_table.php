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
        Schema::create('data_dbd_file', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id_upload");
            $table->integer("bulan");
            $table->year("tahun");
            $table->string("file_url");
            $table->foreign("user_id_upload")->references("id")->on("users");
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
        Schema::dropIfExists('data_dbd_file');
    }
};
