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
        Role::create(['name' => 'user']);
        $createUser = Permission::create(['name' => 'create user']);
        $admin = Role::create(['name' => 'admin']);

        $admin->givePermissionTo($createUser);

        $paulo = User::create([
            'name' => 'Paulo',
            'email' => 'paulo.wueliton@hotmail.com',
            'password' => 'pxb2tek!bcr.bxg!PJB'
        ]);

        $paulo->assignRole('admin');
    }
}
