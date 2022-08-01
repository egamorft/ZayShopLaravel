<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->id('product_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('product_name');
            $table->string('product_quantity', 50);
            $table->integer('product_sold')->nullable();
            $table->text('product_desc')->nullable();
            $table->text('product_content')->nullable();
            $table->integer('product_price');
            $table->string('product_image');
            $table->integer('product_status');
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
        Schema::dropIfExists('tbl_product');
    }
}
