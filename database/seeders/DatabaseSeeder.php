<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        $permissions = [
            'role-list',
            //1
            'role-create',
            //2
            'role-edit',
            //3
            'role-delete',
            //4
            'user-list',
            //5
            'user-create',
            //6
            'user-edit',
            //7
            'user-delete',
            //8
            'demande-list',
            //9
            'demande-create',
            //10
            'demande-edit',
            //11
            'demande-delete',
            //12
            'demande-validat',
            //13
            'demande-rejete', //14

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = User::create([
            'name' => 'admin',
            // smit xarika MasterArchives
            'email' => 'admin@master-archives.ma',
            'password' => bcrypt('12345678')
        ]);
        $gerant = User::create([
            'name' => 'gerant',
            //shiha nn kifax katktb geron gerant
            'email' => 'gerant@master-archives.ma',
            'password' => bcrypt('12345678')
        ]);
        $dircteur = User::create([
            'name' => 'dircteur',
            //shiha nn kifax katktb geron gerant
            'email' => 'dircteur@master-archives.ma',
            'password' => bcrypt('12345678')
        ]);
        $employer = User::create([
            'name' => 'employer',
            //shiha nn kifax katktb geron gerant
            'email' => 'employer@master-archives.ma',
            'password' => bcrypt('12345678')
        ]);

        $roleadmin = Role::create(['name' => 'admin']);
        $rolegerant = Role::create(['name' => 'gerant']);
        $roledircteur = Role::create(['name' => 'dircteur']);
        $roleemployer = Role::create(['name' => 'employer']);

        $permissions = Permission::pluck('id', 'id')->all();

        $roleadmin->syncPermissions($permissions);
        $roleemployer->syncPermissions([
            'demande-list',
            //9
            'demande-create',
            //10
            'demande-edit',
            //11
            'demande-delete',
            //12
        ]);

        $admin->assignRole([$roleadmin->id]);
        $gerant->assignRole([$rolegerant->id]);
        $dircteur->assignRole([$roledircteur->id]);
        $employer->assignRole([$roleemployer->id]);
    }
}