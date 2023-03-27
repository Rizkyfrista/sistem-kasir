<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderBelanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_belanjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_karyawan')->constrained('karyawans');
            $table->datetime('tanggal_belanja');
            $table->integer('total_belanja');
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
        Schema::dropIfExists('header_belanjas');
    }
}
