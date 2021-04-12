<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_brand', 50);
            $table->string('image_brand', 100);
            $table->string('url_iklan')->default(null);
            $table->enum('jenis_iklan', ['platinum', 'gold', 'silver', 'bronze']);
            $table->boolean('status')->default(false);
            $table->double('harga_iklan');
            $table->dateTime('masa_waktu');
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
        Schema::dropIfExists('tbl_ads');
    }
}
