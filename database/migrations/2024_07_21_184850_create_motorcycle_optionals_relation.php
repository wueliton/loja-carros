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
        Schema::create('motorcycle_optionals_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motorcycle_id')->constrained(table: 'motorcycles');
            $table->foreignId('motorcycle_optionals_id')->constrained(table: 'motorcycle_optionals');
            $table->foreignId('created_by')->nullable()->constrained(table: 'users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorcycle_optionals_relations');
    }
};
