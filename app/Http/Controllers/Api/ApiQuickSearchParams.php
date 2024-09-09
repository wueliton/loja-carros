<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\CarBrandModel;
use App\Models\MotorcycleBrandModel;

class ApiQuickSearchParams extends Controller
{
    public function quickSearchOptions()
    {
        $brands = Brands::all();

        return response()->json(['brands' => $brands]);
    }
}
