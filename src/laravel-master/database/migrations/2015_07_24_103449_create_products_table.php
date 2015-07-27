<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('slug');
            // $table->string('tags');
            $table->string('title');
            // $table->string('body');
            // $table->string('vendor');
            // $table->string('product-type');
            // $table->string('template');
            // $table->string('options');
            // $table->string('images');
            // $table->string('image');

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
        Schema::drop('products');
    }
}
