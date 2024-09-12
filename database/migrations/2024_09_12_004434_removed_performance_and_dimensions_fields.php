<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("cars", function (Blueprint $table) {
            $table->dropColumn(["seats", "power", "size", "fuel_capacity", "axis_length"]);
        });

        Schema::table("motorcycles", function (Blueprint $table) {
            $table->dropColumn(["fuel_capacity", "size", "axis_length"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("cars", function (Blueprint $table) {
            $table->integer('seats')->nullable();
            $table->string('power')->nullable();
            $table->string('size')->nullable();
            $table->integer('fuel_capacity');
            $table->string('axis_length')->nullable();
        });

        Schema::table("motorcycles", function (Blueprint $table) {
            $table->integer('fuel_capacity');
            $table->string('size')->nullable();
            $table->string('axis_length')->nullable();
        });
    }
};
