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
        Schema::create('motorcycles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedInteger('model_id');
            $table->foreign('model_id')->references('id')->on('motorcycle_brand_models');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('motorcycle_types');
            $table->integer('manufacturing_year');
            $table->integer('year');
            $table->integer('cilynder');
            $table->string('motor');
            $table->unsignedInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->integer('km');
            $table->integer('fuel_capacity');
            $table->string('size');
            $table->string('axis_length');
            $table->string('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorcycles');
    }
};
