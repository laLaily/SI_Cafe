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
        Schema::create("dinein_transactions", function (Blueprint $table) {
            $table->id();
            $table->string("customer_name");
            $table->timestamp("transaction_date");
            $table->foreignId("seat_id")->constrained("seats");
            $table->integer("total_price")->default(0);
            $table->enum("status", ['in progress', 'success'])->default('in progress');
            $table->unsignedBigInteger("updater_id")->nullable();
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
        Schema::dropIfExists("dinein_transactions");
    }
};
