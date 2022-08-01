<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_details', function (Blueprint $table) {
            $table->id('order_details_id');
            $table->string('order_code', 50);
            $table->integer('product_id');
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('product_sales_quantity');
            $table->string('product_coupon', 50);
            $table->string('product_feeship', 50);
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
        Schema::dropIfExists('tbl_order_details');
    }
}
