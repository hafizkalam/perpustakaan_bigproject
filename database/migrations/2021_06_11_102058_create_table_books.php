<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_buku', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kategori');
            $table->string('judul',150);
            $table->text('keterangan');
            $table->integer('stocks');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_buku', function (Blueprint $table) {
            //
        });
    }
}
