<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("detail_dinein_transactions", function (Blueprint $table) {
            $table->foreignId("dinein_transaction_id");
            $table->foreignId("product_id");
            $table->integer("quantity");
            $table->integer("quantity_price");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("detail_dinein_transactions");
    }
};
