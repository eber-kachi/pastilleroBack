<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(1)->create();
//        \App\Models\Rol::factory(3)->create();
        $rol = new Rol();

        $rol->name = 'encargado';
        $rol->display_name = 'Encargado';
        $rol->enabled = 1;
        $rol->save();

        $rol = new Rol();

        $rol->name = 'paciente';
        $rol->display_name = 'Paciente';
        $rol->enabled = 1;
        $rol->save();


        $user = new User();
        $user->name = 'encargado';
        $user->email = 'encargado@gmail.com';
        $user->username = 'encargado';
        $user->email_verified_at = now();
        $user->enabled = 1;
        $user->password = Hash::make('encargado');
        $user->remember_token = Str::random(10);
        $user->rol_id = 1;
        $user->save();

        $user = new User();
        $user->name = 'Paciente';
        $user->email = 'paciente@gmail.com';
        $user->username = 'paciente';
        $user->email_verified_at = now();
        $user->enabled = 1;
        $user->password = Hash::make('paciente');
        $user->remember_token = Str::random(10);
        $user->rol_id = 2;
        $user->save();

        $this->call([

            PacienteSeeder::class,
        ]);

    }
}
