<?php

use App\Models\Store;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Str;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("stores", function (Blueprint $table) {
            $table->string("slug")->unique()->nullable();
        });

        $stores = Store::all();
        $stores->each(function (Store $store) {
            $store->slug = Str::slug($store->name);
            $store->save();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("stores", function (Blueprint $table) {
            $table->dropColumn("slug");
        });
    }
};
