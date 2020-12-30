<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Agregamos los usuarios necesarios "Admin" | "User"
        $user = new User();
        $user->name     = 'Usuario de prueba';
        $user->rfc      = 'GASIOUDBOAUSD';
        $user->email    = 'admin@gmail.com';
        $user->password = '$2y$10$g07CP2.YhICtBSRlJFkPRO1H23.BRbVCO1KUSuXD97q1Rd/6nXRea'; //cocacola
        $user->save();
        $user->roles()->attach(Role::where('name', 'admin')->first());
    }
}
