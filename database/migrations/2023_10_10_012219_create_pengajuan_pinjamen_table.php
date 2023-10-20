<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanPinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_pinjamen', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('jumlah_pinjaman');
            $table->string('tenor_pinjaman');
            $table->string('status_pinjaman'); // 0 draft, 1 sudah upload, 2 menunggu ttd ketua kop, 3 menunggu ttd finance, 4 pprove & pencairan, 5 lunas, 6 ditolak
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
        Schema::dropIfExists('pengajuan_pinjamen');
    }
}
