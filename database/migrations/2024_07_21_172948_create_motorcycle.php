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
            $table->foreignId('brand_id')->constrained(table: 'brands');
            $table->foreignId('model_id')->constrained(table: 'motorcycle_brand_models');
            $table->foreignId('store_id')->constrained(table: 'stores');
            $table->foreignId('type_id')->constrained(table: 'motorcycle_types');
            $table->integer('manufacturing_year');
            $table->integer('year');
            $table->integer('cylinder');
            $table->string('motor');
            $table->foreignId('color_id')->constrained(table: 'colors');
            $table->integer('km');
            $table->integer('fuel_capacity');
            $table->string('size')->nullable();
            $table->string('axis_length')->nullable();
            $table->string('details')->nullable();
            $table->foreignId('created_by')->nullable()->constrained(table: 'users');
            $table->timestamps();
            $table->softDeletes();
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
