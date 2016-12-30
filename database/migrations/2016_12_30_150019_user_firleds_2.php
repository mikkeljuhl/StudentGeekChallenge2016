<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserFirleds2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->string("shipping_address")->nullable();
            $table->string("billing_address")->nullable();
            $table->string("shipping_postcode")->nullable();
            $table->string("billing_postcode")->nullable();
            $table->string("shipping_country")->nullable();
            $table->string("billing_country")->nullable();
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
        //
    }
}
