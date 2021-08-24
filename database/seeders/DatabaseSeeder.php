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
        $rol->name = 'admin';
        $rol->name = 'admin';
        $rol->display_name = 'admin';
        $rol->enabled = 1;
        $rol->save();

        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->username = 'admin';
        $user->email_verified_at = now();
        $user->enabled = 1;
        $user->password = Hash::make('admin');
        $user->remember_token = Str::random(10);
        $user->rol_id = 1;
        $user->save();

        $this->call([

            MemberSeeder::class,
        ]);

    }
}
