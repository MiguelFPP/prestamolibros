<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'identification' => '123456789',
            'name' => 'Miguel',
            'email' => 'miguelferneyp@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => now(),
        ])->assignRole('admin');

        $roles = \Spatie\Permission\Models\Role::all();
        foreach ($roles as $role) {
            $users = User::factory(9)->create();
            foreach ($users as $user) {
                if ($role->name != 'admin') {
                    $user->assignRole($role);
                }
            }
        }
        /* User::factory(9)->create(); */
    }
}
