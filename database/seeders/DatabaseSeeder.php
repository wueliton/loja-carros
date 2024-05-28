<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $admin = Role::create(['name' => 'admin']);
        $createUser = Permission::create(['name' => 'create user']);

        $admin->givePermissionTo($createUser);

        $paulo = User::factory()->create([
            'name' => 'Paulo',
            'email' => 'paulo.wueliton@hotmail.com',
            'password' => 'pxb2tek!bcr.bxg!PJB'
        ]);

        $paulo->assignRole('admin');
    }
}
