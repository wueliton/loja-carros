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
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedInteger('model_id');
            $table->foreign('model_id')->references('id')->on('car_brand_models');
            $table->integer('manufacturing_year');
            $table->integer('year');
            $table->string('version')->nullable();
            $table->unsignedInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->unsignedInteger('fuel_type_id');
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types');
            $table->integer('doors');
            $table->unsignedInteger('transmission_id');
            $table->foreign('transmission_id')->references('id')->on('car_transmissions');
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
