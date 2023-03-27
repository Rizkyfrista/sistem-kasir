<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBelanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_belanjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_belanja')->constrained('header_belanjas');
            $table->foreignId('id_item')->constrained('items');
            $table->integer('quantity');
            $table->integer('jumlah');
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
        Schema::dropIfExists('detail_belanjas');
    }
}
