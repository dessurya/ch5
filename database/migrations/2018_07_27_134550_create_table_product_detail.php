<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hpchs_product_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('name');
            $table->string('picture');
            $table->text('descript');
            $table->string('flag')->default('N');
            $table->timestamps();
        });

        Schema::table('hpchs_product_detail', function($table) {
            $table->foreign('user_id')->references('id')->on('hpchs_users')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('hpchs_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hpchs_product_detail');
    }
}
