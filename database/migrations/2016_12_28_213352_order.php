<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("orders", function (Blueprint $table) {

            $table->increments("id");
            $table->timestamps();
            $table->integer("user_id")->nullable();
            $table->integer("subtotal")->nullable();

            $table->string("shipping_address")->nullable();
            $table->string("shipping_postcode")->nullable();
            $table->string("shipping_city")->nullable();
            $table->string("shipping_country")->nullable();
            $table->string("billing_address")->nullable();
            $table->string("billing_postcode")->nullable();
            $table->string("billing_city")->nullable();
            $table->string("billing_country")->nullable();
            $table->string("name")->nullable();
            $table->string("phone")->nullable();

            $table->integer("shipping_method_id")->nullable();
            $table->string("shipping_method_title")->nullable();
            $table->integer("shipping_method_price")->nullable();
            $table->integer("tax")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("orders");
    }
}
