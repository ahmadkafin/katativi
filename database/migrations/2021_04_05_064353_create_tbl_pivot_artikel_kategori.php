<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPivotArtikelKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pivot_artikel_kategori', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('artikel_id')->unsigned();
            $table->foreign('artikel_id')->references('id')->on('tbl_artikel')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('kategori_id')->unsigned();
            $table->foreign('kategori_id')->references('id')->on('tbl_kategori')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('tbl_pivot_artikel_kategori');
    }
}
