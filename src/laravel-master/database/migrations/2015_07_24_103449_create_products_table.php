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
            $table->integer('active');
            $table->integer('category');
            $table->string('slug');
            // $table->string('tags');
            $table->string('title');
            $table->string('body');
            $table->string('vendor');
            $table->string('collection');
            $table->integer('price');
            $table->string('image')->nullable();
            $table->string('images')->nullable();
            $table->string('images_extra')->nullable();
            $table->string('product_type')->nullable();
            $table->string('template')->nullable();
            $table->string('options')->nullable();

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
