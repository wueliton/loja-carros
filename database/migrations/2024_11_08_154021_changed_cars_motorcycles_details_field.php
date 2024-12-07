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
            $table->text('details')->change();
        });

        Schema::table("motorcycles", function (Blueprint $table) {
            $table->text('details')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("cars", function (Blueprint $table) {
            $table->string('details')->change();
        });

        Schema::table("motorcycles", function (Blueprint $table) {
            $table->string('details')->change();
        });
    }
};
