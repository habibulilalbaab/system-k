<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopUpPinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_up_pinjamen', function (Blueprint $table) {
            $table->id();
            $table->string('pinjaman_id');
            $table->string('user_id');
            $table->string('topup_type');
            $table->string('sisa_pinjaman');
            $table->string('tenor');
            $table->text('reason');
            $table->string('status');
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
        Schema::dropIfExists('top_up_pinjamen');
    }
}
