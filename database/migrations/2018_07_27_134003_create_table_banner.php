<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hpchs_banner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->string('picture');
            $table->string('text_one')->nullable();
            $table->string('text_two')->nullable();
            $table->string('flag')->default('N');
            $table->timestamps();
        });

        Schema::table('hpchs_banner', function($table) {
            $table->foreign('user_id')->references('id')->on('hpchs_users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hpchs_banner');
    }
}
