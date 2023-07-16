<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
                'name'=> 'Admin',
                'email'=>'admin@udenar.edu.co',
                'password'=> bcrypt('admin123')
        ])->assignRole('admin');

        User::create([
            'name'=> 'Coordinador',
            'email'=>'coordinador@udenar.edu.co',
            'password'=> bcrypt('admin123')
        ])->assignRole('coordinador');

        User::create([
            'name'=> 'Semillerista',
            'email'=>'semillerista@udenar.edu.co',
            'password'=> bcrypt('admin123')
        ])->assignRole('semillerista');

        User::create([
            'name'=> 'Daniel Garcia',
            'email'=>'daniel.g@udenar.edu.co',
            'password'=> bcrypt('admin123')
        ])->assignRole('admin');

        User::create([
            'name'=> 'Paola Arturo',
            'email'=>'paola.a@udenar.edu.co',
            'password'=> bcrypt('admin123')
        ])->assignRole('coordinador');

        User::create([
            'name'=> 'Jorge Muñoz',
            'email'=>'jorje.m@udenar.edu.co',
            'password'=> bcrypt('admin123')
        ])->assignRole('semillerista');
        
        User::create([
            'name'=> 'Segundo Paladines',
            'email'=>'segundo.p@udenar.edu.co',
            'password'=> bcrypt('admin123')
        ])->assignRole('admin');

        User::create([
            'name'=> 'Snadra Vallejo',
            'email'=>'sandra.v@udenar.edu.co',
            'password'=> bcrypt('admin123')
        ])->assignRole('coordinador');

        User::create([
            'name'=> 'Julian Paz',
            'email'=>'Julian.p@udenar.edu.co',
            'password'=> bcrypt('admin123')
        ])->assignRole('semillerista');

       //generar aleatorios User::factory(9)->create();
    }
}
