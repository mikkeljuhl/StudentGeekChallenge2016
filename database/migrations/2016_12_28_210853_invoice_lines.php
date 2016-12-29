<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceLines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("invoice_lines", function (Blueprint $table) {
            $table->increments("id");
            $table->timestamps();
            $table->integer("price");
            $table->integer("qty");
            $table->string("product_sku");
            $table->string("title");
            $table->integer("order_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("invoice_lines");
    }
}
