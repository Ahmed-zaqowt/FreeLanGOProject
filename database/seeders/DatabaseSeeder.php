<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Country;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Skill::factory(8)->create();
        // \App\Models\User::factory(10)->create();

        /* \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('123456789'),
        ]);*/
        /*
          \App\Models\Admin::create([
             'name' => 'Test Admin 3',
             'email' => 'admin3@example.com',
             'phone' => '0599166113',
             'password' => Hash::make('123456789'),
         ]);
*/
        /* \App\Models\Freelancer::create([
             'fullname' => 'Test Freelancer',
             'username' => 'TestFreelancer',
             'phone' => '0599166117',
             'country' => 'gaza' ,
             'email' => 'freelancer@example.com',
             'password' => Hash::make('123456789'),
         ]);*/

        /* users :  view , store , update , delete */
        // create perm
        /*Permission::create(['name' => 'users.view' , 'guard_name' => 'admin']);
        Permission::create(['name' => 'users.store', 'guard_name' => 'admin']);
        Permission::create(['name' => 'users.update', 'guard_name' => 'admin']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'admin']);

        // create roles
        $super =  Role::create(['name' => 'super', 'guard_name' => 'admin']);
        $viewer = Role::create(['name' => 'viewer', 'guard_name' => 'admin']);
        $editor = Role::create(['name' => 'editor', 'guard_name' => 'admin']);

        // give per to role
        $super->givePermissionTo(Permission::all());
        $viewer->givePermissionTo(['users.view']);
        $editor->givePermissionTo(['users.view', 'users.update', 'users.delete']);
*/
        // give per to user
        /* $user = Admin::find(1);
        $user->syncRoles('super');*/
        /*
      $models = ['User'] ;
      $actions = ['store' , 'view' , 'update' , 'delete'];

      $super =  Role::firstOrCreate(['name' => 'super', 'guard_name' => 'admin']);
      foreach($models as $model){
        foreach($actions as $action){
            $permName = "$model.$action" ;
            $permission = Permission::firstOrCreate([
                'name' => $permName ,
                'guard_name' => 'admin' ,
            ]);
            $super->givePermissionTo($permission);
        }
      }
*/



/*
        $json = File::get(database_path('data/countries_ar.json'));
        $countries = json_decode($json, true);

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']],
                ['name_ar' => $country['name_ar'], 'phone_code' => $country['phone_code']]
            );
        }*/


         \App\Models\User::create([
            'fullname' => 'Test User',
            'username' => 'TestUser',
            'email' => 'user@example.com',
            'password' => Hash::make('123456789'),
        ]);

    }
}
