<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'super']);

        $paulo = User::create([
            'name' => 'Paulo',
            'email' => 'paulo.wueliton@hotmail.com',
            'password' => 'pxb2tek!bcr.bxg!PJB'
        ]);

        $paulo->assignRole('super');

        $bruna = User::create([
            'name' => 'Bruna',
            'email' => 'bruna.conceitopub@gmail.com',
            'password' => 'Mudar@123'
        ]);

        $bruna->assignRole('admin');
    }
}
