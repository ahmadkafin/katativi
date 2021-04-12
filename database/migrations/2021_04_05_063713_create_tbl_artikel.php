<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblArtikel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_artikel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slugs');
            $table->longText('body');
            $table->boolean('status')->default(false)->comment('status publish 0 = unpublished');
            $table->enum('jenis', ['baru', 'lama']);
            $table->integer('counting_klik');
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
        Schema::dropIfExists('tbl_artikel');
    }
}
