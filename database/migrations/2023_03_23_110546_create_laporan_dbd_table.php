<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('laporan_dbd', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('laporan_dbd_file_id');

      $table->string('kecamatan_dijumpai_dbd')->nullable();
      $table->string('puskesmas_dijumpai_dbd')->nullable();
      $table->string('desa_kelurahan_dijumpai_dbd')->nullable();
      $table->integer('jumlah_penduduk_desa_kelurahan')->nullable();

//       lk = laki2, pr = prempuan, p = penderita, m = meninggal
//      jumlah kasus usia dibawah  1 tahun (u1)
      $table->integer('jumlah_kasus_u1_lk_p')->default(0);
      $table->integer('jumlah_kasus_u1_lk_m')->default(0);
      $table->integer('jumlah_kasus_u1_pr_p')->default(0);
      $table->integer('jumlah_kasus_u1_pr_m')->default(0);
//      jumlah kasus usia  1 tahun - 4 tahun (u1sd4)
      $table->integer('jumlah_kasus_u1sd4_lk_p')->default(0);
      $table->integer('jumlah_kasus_u1sd4_lk_m')->default(0);
      $table->integer('jumlah_kasus_u1sd4_pr_p')->default(0);
      $table->integer('jumlah_kasus_u1sd4_pr_m')->default(0);
//      jumlah kasus usia  5 tahun - 9 tahun (u5sd9)
      $table->integer('jumlah_kasus_u5sd9_lk_p')->default(0);
      $table->integer('jumlah_kasus_u5sd9_lk_m')->default(0);
      $table->integer('jumlah_kasus_u5sd9_pr_p')->default(0);
      $table->integer('jumlah_kasus_u5sd9_pr_m')->default(0);
//      jumlah kasus usia  10 tahun - 14 tahun (u10sd14)
      $table->integer('jumlah_kasus_u10sd14_lk_p')->default(0);
      $table->integer('jumlah_kasus_u10sd14_lk_m')->default(0);
      $table->integer('jumlah_kasus_u10sd14_pr_p')->default(0);
      $table->integer('jumlah_kasus_u10sd14_pr_m')->default(0);
      //      jumlah kasus usia  15 tahun - 44 tahun (u15sd44)
      $table->integer('jumlah_kasus_u15sd44_lk_p')->default(0);
      $table->integer('jumlah_kasus_u15sd44_lk_m')->default(0);
      $table->integer('jumlah_kasus_u15sd44_pr_p')->default(0);
      $table->integer('jumlah_kasus_u15sd44_pr_m')->default(0);
      //      jumlah kasus usia diatas  44 tahun (u44)
      $table->integer('jumlah_kasus_u44_lk_p')->default(0);
      $table->integer('jumlah_kasus_u44_lk_m')->default(0);
      $table->integer('jumlah_kasus_u44_pr_p')->default(0);
      $table->integer('jumlah_kasus_u44_pr_m')->default(0);
      $table->integer('jumlah_kasus_u_tidak_tau')->default(0);


      $table->integer('jumlah_kasus_lk')->default(0);
      $table->integer('jumlah_kasus_pr')->default(0);
      $table->integer('jumlah_kasus_penderita')->default(0);
      $table->integer('jumlah_kasus_meninggal')->default(0);

      $table->float('ir_dbd');
      $table->float('crf_dbd');
      $table->integer('jumlah_desakel_penyelidikan_epidemologi')->default(0);
      $table->integer('jumlah_desakel_psn_dbd_3mp_masal')->default(0);
      $table->integer('jumlah_rumah_bangunan_larvasidasi')->default(0);
      $table->integer('jumlah_desakel_penyuluhan')->default(0);
      $table->integer('jumlah_pelaksanaan_fogging')->default(0);

      $table->integer('jumlah_rumah_pelaksanaan_fogging')->default(0);
      $table->integer('jumlah_bangunan_pelaksanaan_fogging')->default(0);

      $table->integer('jumlah_rumah_pelaksanaan_smp_fogging')->default(0);
      $table->integer('jumlah_bangunan_pelaksanaan_smp_fogging')->default(0);

      $table->integer('jumlah_rumah_bangunan_pjb')->default(0);
      $table->integer('jumlah_rumah_bangunan_temu_jentik')->default(0);

      $table->float('abj');

      $table->foreign('laporan_dbd_file_id')->references('id')->on('laporan_dbd_files');
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
    Schema::dropIfExists('laporan_dbd');
  }
};
