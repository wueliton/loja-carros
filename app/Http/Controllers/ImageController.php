<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getImage(Request $request, String $imageName)
    {
        $path = storage_path('app/public/uploads/' . $imageName);
        return response()->file($path);
    }
}
