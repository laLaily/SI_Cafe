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
        Schema::create("reservation_transactions", function (Blueprint $table) {
            $table->id();
            $table->string("customer_name");
            $table->timestamp("reservation_date");
            $table->integer("total_person");
            $table->foreignId("dinein_transaction_id")->constrained("dinein_transactions")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("reservation_transactions");
    }
};
