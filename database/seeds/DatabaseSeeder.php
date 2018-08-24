<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(RolsTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(DocumentsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AuthsTableSeeder::class);
    }

}
