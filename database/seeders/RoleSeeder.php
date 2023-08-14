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

        //******************INICIO <- permisos para visualizacion del HOME y sus componenetes**********************

        //todos pueden ver
        Permission::create(['name'=>"home"])->syncRoles($coordinador, $director, $semillerista);
        Permission::create(['name'=>"perfil"])->syncRoles($coordinador, $director, $semillerista);
        Permission::create(['name'=>"eventos"])->syncRoles($director, $coordinador, $semillerista);

        //coordinador y semillerista pueden ver
        Permission::create(['name'=>"coordinador-semillerista.semillero"])->syncRoles($coordinador, $semillerista);

        //solo el director puede ver
        Permission::create(['name'=>"director.administracion"])->syncRoles($director);
        Permission::create(['name'=>"director.proyectos"])->syncRoles($director);
        Permission::create(['name'=>"director.usuarios"])->syncRoles($director);
        Permission::create(['name'=>"director.semilleros"])->syncRoles($director);
        
        //solo el coordinador puede ver
        Permission::create(['name'=>"coordinador.administracion"])->syncRoles($coordinador);
        Permission::create(['name'=>"coordinador.proyectos"])->syncRoles($coordinador);
        
        //solo el semillerista puede ver
        Permission::create(['name'=>"semillerista.proyectos"])->syncRoles($semillerista);
        
        Permission::create(['name'=>"director-coordinador.eventos"])->syncRoles($director,$coordinador);
        //*******************FIN <- persmisos para visualizacion del HOME y sus componentes*******************************************************************
        
    }
}
