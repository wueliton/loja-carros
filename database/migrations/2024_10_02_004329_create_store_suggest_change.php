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
        Schema::create('store_change_suggests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo_url');
            $table->string('store_number');
            $table->string('email');
            $table->integer('phone');
            $table->integer('whatsapp');
            $table->enum('status', ['pending', 'approved', 'reproved'])->default('pending');
            $table->foreignId('created_by')->nullable()->constrained(table: 'users');
            $table->foreignId('store_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_change_suggests');
    }
};