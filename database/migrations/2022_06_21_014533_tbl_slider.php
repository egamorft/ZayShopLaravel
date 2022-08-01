<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_slider', function (Blueprint $table) {
            $table->id('slider_id');
            $table->string('slider_name');
            $table->string('slider_image');
            $table->text('slider_desc')->nullable();
            $table->integer('slider_status');
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
        Schema::dropIfExists('tbl_slider');
    }
}
