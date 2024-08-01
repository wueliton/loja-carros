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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('brand_id')->constrained(table: 'brands');
            $table->foreignId('model_id')->constrained(table: 'car_brand_models');
            $table->integer('manufacturing_year');
            $table->integer('year');
            $table->string('version')->nullable();
            $table->foreignId('color_id')->constrained(table: 'colors');
            $table->foreignId('fuel_type_id')->constrained(table: 'fuel_types');
            $table->integer('doors');
            $table->foreignId('transmission_id')->constrained(table: 'car_transmissions');
            $table->string('motor');
            $table->integer('km');
            $table->string('last_digit');
            $table->string('details')->nullable();
            $table->integer('seats')->nullable();
            $table->string('power')->nullable();
            $table->string('size')->nullable();
            $table->integer('fuel_capacity');
            $table->string('axis_length')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
