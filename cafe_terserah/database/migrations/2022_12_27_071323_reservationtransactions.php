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
            $table->unsignedBigInteger("dinein_id")->nullable();
            $table->foreign("dinein_id")->references("id")->on("dinein_transactions");
            $table->enum("status", ["reserved", "in progress", "done"])->default("reserved");
            $table->timestamp("updated_at")->nullable();
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
        Schema::dropIfExists("reservation_transactions");
    }
};
