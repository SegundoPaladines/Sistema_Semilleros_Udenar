<?php

namespace Database\Seeders;

use App\Models\Semillerista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creacion de los roles
        $director = Role::create(['name'=>'admin']);
        $coordinador = Role::create(['name'=>'coordinador']);
        $semillerista = Role::create(['name'=>'semillerista']);

        Permission::create(['name'=>"coordinador.home"])->syncRoles($coordinador,$director, $semillerista);
        Permission::create(['name'=>"admin.pages"])->syncRoles($coordinador,$director, $semillerista);
        Permission::create(['name'=>"admin.settings"])->syncRoles($director);
        
    }
}
