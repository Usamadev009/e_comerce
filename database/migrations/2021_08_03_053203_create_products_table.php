<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id()->unique();
            $table->string('name');
            $table->integer('sub_category_id');
            $table->string('url');
            $table->mediumText('small_description');
            $table->string('image');

            $table->integer('original_price');
            $table->integer('offer_price');
            $table->string('tax_amt');
            $table->integer('quantity');
            $table->integer('priority');


            $table->string('p_highlight_heading')->nullable();
            $table->longText('p_highlights')->nullable();
            $table->string('p_description_heading')->nullable();
            $table->longText('p_description')->nullable();
            $table->string('p_details_heading')->nullable();
            $table->longText('p_details')->nullable();


            $table->tinyInteger('new_product')->default('0');
            $table->tinyInteger('featured_products')->default('0');
            $table->tinyInteger('popular_products')->default('0');
            $table->tinyInteger('offer_products')->default('0');
            $table->tinyInteger('status')->default('0');

            $table->integer('vendor_id');
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
        Schema::dropIfExists('products');
    }
}
