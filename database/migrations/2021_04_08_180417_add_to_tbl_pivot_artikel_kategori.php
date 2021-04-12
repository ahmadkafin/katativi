<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToTblPivotArtikelKategori extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_pivot_artikel_kategori', function (Blueprint $table) {
            $table->bigInteger('tags_id')->unsigned();
            $table->foreign('tags_id')->references('id')->on('tbl_tags')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_pivot_artikel_kategori', function (Blueprint $table) {
            //
        });
    }
}
