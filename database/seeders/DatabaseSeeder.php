<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Role::create(['name' => 'admin'])->givePermissionTo(['create', 'edit', 'delete']);
        Role::create(['name' => 'user']);
        User::create([
            'name' => 'Ahmed Essam',
            'email' => "aahmedessam32@yahoo.com",
            'username' => "aahmedessam32",
            'password' => Hash::make('01094286927'),
            'phone' => '01094286927',
            'remember_token' => Str::random(10),
        ])->assignRole('admin');
        $users = User::factory(30)->create();
        foreach ($users as $user) {
            $user->assignRole('user');
        }
    }
}
