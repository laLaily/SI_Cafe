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
            $table->bigInteger("dinein_id")->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->integer("quantity");
            $table->integer("quantity_price");

            $table->primary(["dinein_id", "product_id"]);

            $table->foreign("dinein_id")->references("id")->on("dinein_transactions");
            $table->foreign("product_id")->references("id")->on("products")->nullOnDelete();
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
