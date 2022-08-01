<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_account', function (Blueprint $table) {
            $table->id('account_id');
            $table->string('account_name', 50);
            $table->string('account_email')->unique();
            $table->string('account_password');
            $table->string('account_phone');
            $table->text('account_address')->nullable();
            $table->boolean('account_confirmation')->default(0);
            $table->string('verify_code')->nullable();
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
        Schema::dropIfExists('tbl_account');
    }
}
