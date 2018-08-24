<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'nombre' => 'Julian Andres Lasso Figueroa',
            'correo' => 'jalasso69@misena.edu.co',
            'telefono' => '3113215870',
            'numero_documento' => '123456',
            'genero' => 1,
            'tipo_documento' => 1
        ]);
    }

}
