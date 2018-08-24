<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('genders')->insert([
            'nombre' => 'Masculino'
        ]);
        DB::table('genders')->insert([
            'nombre' => 'Femenino'
        ]);
        DB::table('genders')->insert([
            'nombre' => 'Indefinido'
        ]);
    }

}
