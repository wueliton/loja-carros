<?php

namespace Database\Seeders;

use App\Models\Car;
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
        Role::firstOrCreate(['name' => 'user']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'super']);

        $paulo = User::withTrashed()->where('email', 'paulo.wueliton@hotmail.com')->first();

        if (!$paulo) {
            $paulo = User::firstOrCreate([
                'name' => 'Paulo',
                'email' => 'paulo.wueliton@hotmail.com',
                'password' => 'pxb2tek!bcr.bxg!PJB'
            ]);
        } else if ($paulo->trashed()) {
            $paulo->restore();
        }



        if (!$paulo->hasRole('super')) {
            $paulo->syncRoles('super');
        }

        $bruna = User::where('email', 'bruna.conceitopub@gmail.com')->first();

        if (!$bruna) {
            $bruna = User::firstOrCreate([
                'name' => 'Bruna',
                'email' => 'bruna.conceitopub@gmail.com',
                'password' => 'Mudar@123'
            ]);
        }

        if (!$bruna->hasRole('super')) {
            $bruna->syncRoles('super');
        }

        $cars = Car::all();
        $cars->each(function (Car $car) {

        });

    }
}
