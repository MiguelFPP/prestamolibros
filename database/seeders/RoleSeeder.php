<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'secretary']);
        $role3 = Role::create(['name' => 'client']);

        Permission::create(['name' => 'home'])->syncRoles([$role1, $role2]);

        Permission::create(['name'=>'authors.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'authors.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'authors.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'authors.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'authors.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'authors.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name'=>'categories.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'categories.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'categories.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'categories.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'categories.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'categories.destroy'])->syncRoles([$role1, $role2]);

        Permission::create(['name'=>'books.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'books.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'books.store'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'books.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'books.update'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'books.destroy'])->syncRoles([$role1, $role2]);
    }
}
