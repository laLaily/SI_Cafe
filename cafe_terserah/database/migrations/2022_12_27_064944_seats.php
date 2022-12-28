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
        //
        Schema::create("seats", function (Blueprint $table) {
            $table->id();
            $table->string("seat_number");
            $table->string("seat_type");
            $table->timestamps();
            $table->foreign("admin_id")->references("id")->on("seats");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("seats");
    }
};
