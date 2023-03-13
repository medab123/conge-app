<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Contrat;
use App\Models\Position;
use App\Models\Projet;
use App\Models\Type;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
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
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'demande-list',
            'demande-create',
            'demande-edit',
            'demande-delete',
            'resource-list',
            'resource-create',
            'resource-edit',
            'resource-delete',
            'demande-rejete',
            'demande-validat',
            'type-list','type-create','type-edit','type-delete','type-activate','type-deactivate',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin = User::create([
            'name' => 'admin', 
            'lname' => 'test',
            'email' => 'admin@master-archives.ma',
            'password' => bcrypt('12345678')
        ]);
        $gerant = User::create([
            'name' => 'gerant', 
            'lname' => 'test',
            'email' => 'gerant@master-archives.ma',
            'password' => bcrypt('12345678')
        ]);
        $dircteur = User::create([
            'name' => 'dircteur', 
            'lname' => 'test',
            'email' => 'dircteur@master-archives.ma',
            'password' => bcrypt('12345678')
        ]);
        $employer = User::create([
            'name' => 'employe', 
            'lname' => 'test',
            'email' => 'employer@master-archives.ma',
            'password' => bcrypt('12345678')
        ]);
       
        
    
        $roleadmin = Role::create(['name' => 'admin']);
        $rolegerant = Role::create(['name' => 'gerant']);
        $roledircteur = Role::create(['name' => 'dircteur']);
        $roleemployer = Role::create(['name' => 'employer']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $roleadmin->syncPermissions($permissions);
     
        $admin->assignRole([$roleadmin->id]);
        $gerant->assignRole([$rolegerant->id]);
        $dircteur->assignRole([$roledircteur->id]);
        $employer->assignRole([$roleemployer->id]);


      /*  $year = Carbon::now()->year;
        $start_date = Carbon::parse($year."-01-01");
        $end_date = Carbon::parse($year."-12-31");
        Type::create(['name'=>"congé annuel $year","description"=>"congé paye depui ton solde","start_date"=>$start_date,"end_date"=>$end_date,"active"=>true]);
        Type::create(['name'=>"Congé maladie","description"=>"le congé maladie n’est pas rémunéré par l’employeur","active"=>true]);
        Type::create(['name'=>"Congé maternité et naissance","description"=>"congé paye","active"=>true]);
        Type::create(['name'=>"Congé de récuperation","description"=>"congé de récuperation","active"=>true]);

        Contrat::create(['name'=>"CDI 21 jour","nb_jours"=>21]);*/
        Position::create(['name'=>"indexeur"]);
        Projet::create(['name'=>"ONEE",'ville'=>'Rabat','manager_id'=>2]);
    }
}