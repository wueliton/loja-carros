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
            $table->unsignedInteger('motorcycle_id');
            $table->unsignedInteger('motorcycle_optionals_id');
            $table->foreign('motorcycle_id')->references('id')->on('motorcycles')->onDelete('cascade');
            $table->foreign('motorcycle_optionals_id')->references('id')->on('motorcycle_optionals');
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
