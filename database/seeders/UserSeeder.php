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
                'email'=>'admin@gmail.com',
                'password'=> bcrypt('admin123')
        ])->assignRole('admin');

        User::create([
            'name'=> 'Coordinador',
            'email'=>'coordinador@gmail.com',
            'password'=> bcrypt('admin123')
        ])->assignRole('coordinador');

        User::create([
            'name'=> 'Semillerista',
            'email'=>'semillerista@gmail.com',
            'password'=> bcrypt('admin123')
        ])->assignRole('semillerista');

       //generar aleatorios User::factory(9)->create();
    }
}
