<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngsuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->string('pinjaman_id');
            $table->string('periode');
            $table->string('tanggal');
            $table->string('jumlah');
            $table->string('bunga');
            $table->string('status');
            $table->string('bukti_url')->nullable();
            $table->string('paid_date')->nullable();
            $table->text('resi')->nullable();
            $table->string('sisa_pinjaman');
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
        Schema::dropIfExists('angsurans');
    }
}
