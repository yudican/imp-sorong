<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('nama_arsip')->nullable();
            $table->string('jenis_arsip')->nullable();
            $table->date('tanggal_arsip')->nullable();
            $table->string('file_arsip')->nullable();
            $table->foreignId('jenis_arsip_id');
            $table->timestamps();
            $table->foreign('jenis_arsip_id')->references('id')->on('jenis_arsip')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives');
    }
}
