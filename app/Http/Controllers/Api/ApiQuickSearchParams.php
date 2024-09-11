<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\CarOptional;
use App\Models\CarTransmission;
use App\Models\Color;
use App\Models\FuelType;
use App\Models\MotorcycleOptional;
use App\Models\MotorcycleTypes;
use App\Models\Store;

class ApiQuickSearchParams extends Controller
{
    public function quickSearchOptions()
    {
        $brands = Brands::all();

        return response()->json(['brands' => $brands]);
    }

    public function advancedSearchOptions()
    {
        $brands = Brands::all();
        $fuelTypes = FuelType::all();
        $color = Color::all();
        $transmission = CarTransmission::all();
        $stores = Store::all();
        $carOptionals = CarOptional::all();
        $motorcycleOptionals = MotorcycleOptional::all();
        $motorcycleTypes = MotorcycleTypes::all();

        return response()->json([
            'brands' => $brands,
            'fuelTypes' => $fuelTypes,
            'colors' => $color,
            'stores' => $stores,
            'cars' => [
                'transmissions' => $transmission,
                'optionals' => $carOptionals
            ],
            'motorcycles' => [
                'optionals' => $motorcycleOptionals,
                'types' => $motorcycleTypes
            ]
        ]);
    }
}
