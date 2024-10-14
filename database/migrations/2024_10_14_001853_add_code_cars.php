<?php

use App\Models\Car;
use App\Models\Motorcycle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('code')->nullable();
        });

        $cars = Car::all();
        $cars->each(function (Car $car) {
            $data = new DateTime($car->created_at);
            $year = $data->format('Y');
            $car->code = $car->id . $year;
            $car->save();
        });

        Schema::table('motorcycles', function (Blueprint $table) {
            $table->string('code')->nullable();
        });

        $motorcycles = Motorcycle::all();
        $motorcycles->each(function (Motorcycle $motorcycle) {
            $data = new DateTime($motorcycle->created_at);
            $year = $data->format('Y');
            $motorcycle->code = $motorcycle->id . $year;
            $motorcycle->save();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('code');
        });

        Schema::table('motorcycles', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};
