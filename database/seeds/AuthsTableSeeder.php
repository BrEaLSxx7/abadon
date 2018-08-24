<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('authentications')->insert([
            'usuario' => 'Admin',
            'contrasena' => Hash::make('admin'),
            'id_usuario' => 1,
            'id_rol' => 1
        ]);
    }

}
