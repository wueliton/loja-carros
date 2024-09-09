<?php

use App\Models\Car;
use App\Models\Motorcycle;
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
        Schema::table("cars", function (Blueprint $table) {
            $table->string("slug")->unique()->nullable();
        });

        $cars = Car::all();
        $cars->each(function (Car $car) {
            $car->slug = Str::slug($car->title);
            $car->save();
        });

        Schema::table("motorcycles", function (Blueprint $table) {
            $table->string("slug")->nullable();
        });

        $motorcycles = Motorcycle::all();
        $motorcycles->each(function (Motorcycle $motorcycle) {
            $motorcycle->slug = Str::slug($motorcycle->title);
            $motorcycle->save();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("cars", function (Blueprint $table) {
            $table->dropColumn("slug");
        });

        Schema::table("motorcycles", function (Blueprint $table) {
            $table->dropColumn("slug");
        });
    }
};
