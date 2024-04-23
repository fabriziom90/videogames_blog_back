<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // // create permissions
        // Permission::create(['name' => 'edit posts']);
        // Permission::create(['name' => 'delete posts']);
        // Permission::create(['name' => 'create posts']);
        // Permission::create(['name' => 'show posts']);

        // Permission::create(['name' => 'edit categories']);
        // Permission::create(['name' => 'delete categories']);
        // Permission::create(['name' => 'create categories']);
        // Permission::create(['name' => 'show categories']);

        // Permission::create(['name' => 'edit tags']);
        // Permission::create(['name' => 'delete tags']);
        // Permission::create(['name' => 'create tags']);
        // Permission::create(['name' => 'show tags']);

        // // create roles and assign existing permissions
        // $userRole = Role::create(['name' => 'user']);
        // $userRole->givePermissionTo('create posts');
        // $userRole->givePermissionTo('show posts');
        // $userRole->givePermissionTo('edit posts');
        // $userRole->givePermissionTo('delete posts');

        // $adminRole = Role::create(['name' => 'admin']);
        // $adminRole->givePermissionTo('create posts');
        // $adminRole->givePermissionTo('show posts');
        // $adminRole->givePermissionTo('edit posts');
        // $adminRole->givePermissionTo('delete posts');

        // $adminRole->givePermissionTo('create categories');
        // $adminRole->givePermissionTo('show categories');
        // $adminRole->givePermissionTo('edit categories');
        // $adminRole->givePermissionTo('delete categories');
        
        // $adminRole->givePermissionTo('create tags');
        // $adminRole->givePermissionTo('show tags');
        // $adminRole->givePermissionTo('edit tags');
        // $adminRole->givePermissionTo('delete tags');

        $user = User::find(1);
        $user->assignRole('admin');

    }
}
