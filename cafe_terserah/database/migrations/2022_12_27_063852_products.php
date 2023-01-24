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
        Schema::create("products", function (Blueprint $table) {
            $table->id();
            $table->string("product_name");
            $table->enum("product_category", ["food", "beverage", "dessert"]);
            $table->integer("product_price");
            $table->integer("product_stock");
            $table->timestamps();
            $table->unsignedBigInteger("updater_id");
            $table->foreign("updater_id")->references("id")->on("admins");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("products");
    }
};
