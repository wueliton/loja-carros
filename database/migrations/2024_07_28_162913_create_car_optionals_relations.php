<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_optionals_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained(table: 'cars');
            $table->foreignId('car_optional_id')->constrained(table: 'car_optionals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_optionals_relations');
    }
};
