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
            $table->unsignedInteger('visits')->default(0);
        });

        Schema::table("motorcycles", function (Blueprint $table) {
            $table->unsignedInteger('visits')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("cars", function (Blueprint $table) {
            $table->dropColumn('visits');
        });

        Schema::table("motorcycles", function (Blueprint $table) {
            $table->dropColumn('visits');
        });
    }
};
