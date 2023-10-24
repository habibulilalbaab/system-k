<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanPinjamanLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_pinjaman_logs', function (Blueprint $table) {
            $table->id();
            $table->string('pengajuan_id');
            $table->string('title');
            $table->string('icon');
            $table->text('description');
            $table->boolean('is_doc')->nullable();
            $table->string('doc_path')->nullable();
            $table->string('doc_label')->nullable();
            $table->boolean('is_url')->nullable();
            $table->string('url_path')->nullable();
            $table->string('url_label')->nullable();
            $table->boolean('for_admin')->nullable();
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
        Schema::dropIfExists('pengajuan_pinjaman_logs');
    }
}
