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
            $table->integer('active')->default(1);
            $table->integer('category')->default(1);
            $table->string('slug')->unique();
            // $table->string('tags');
            $table->string('title');
            $table->string('vendor')->nullable();
            $table->string('collection')->nullable();
            $table->integer('price')->nullable();
            $table->string('price_currency')->nullable();
            $table->string('image')->nullable();
            $table->string('images')->nullable();
            $table->string('images_extra')->nullable();
            $table->string('description')->nullable();
            $table->string('description_extra')->nullable();
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
