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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');$table->unsignedBigInteger('admin_id');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('penulis_id');
            $table->unsignedBigInteger('artis_id');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('penulis_id')->references('id')->on('penulis');
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('artis_id')->references('id')->on('artis');
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
        Schema::dropIfExists('news');
    }
};
