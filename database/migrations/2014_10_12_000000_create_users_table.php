<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string("role")->default("u");
            $table->string("shipping_address")->nullable();
            $table->string("billing_address")->nullable();
            $table->string("shipping_postcode")->nullable();
            $table->string("billing_postcode")->nullable();
            $table->string("shipping_country")->nullable();
            $table->string("billing_country")->nullable();
            $table->string("shipping_city")->nullable();
            $table->string("billing_city")->nullable();
            $table->string("phone")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
