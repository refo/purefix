<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('active')->default(1);
            $table->string('title')->default('');
            $table->integer('inventory')->default(0);
            $table->integer('sales')->default(0);
            $table->integer('price')->nullable();
            $table->string('price_currency')->nullable();
            $table->string('url_n11')->nullable();

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
        Schema::drop('product_variants');
    }
}
