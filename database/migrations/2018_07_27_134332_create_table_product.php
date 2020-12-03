<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hpchs_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('picture');
            $table->string('flag')->default('N');
            $table->timestamps();
        });

        Schema::table('hpchs_product', function($table) {
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
        Schema::dropIfExists('hpchs_product');
    }
}
