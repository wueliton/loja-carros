<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageUploadService
{
    public function __construct(protected $manager = new ImageManager(Driver::class))
    {
    }

    public function upload(UploadedFile $file, $imageName = null)
    {
        $fileName = $imageName ?? time() . '_' . mt_rand(100000, 999999) . '.jpg';
        $filePath = public_path('storage/uploads/' . $fileName);
        $img = $this->manager->read($file);
        $encoded = $img->encodeByMediaType('image/jpeg', progressive: true, quality: 80);
        $encoded->save($filePath);
        return $fileName;
    }
}
