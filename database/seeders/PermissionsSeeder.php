<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;



class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $bruna = User::where('email', 'bruna.conceitopub@gmail.com')->first();
        $bruna->syncRoles(['super']);
    }
}
