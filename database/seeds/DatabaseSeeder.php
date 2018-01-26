<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
      $this->call([
        RolesSeeder::class,
        PeriodsTableSeeder::class,
        AuditoriaTableSeeder::class,
        CallsTableSeeder::class,
        UsersTableSeeder::class,
        DefaultRequirementsTableSeeder::class,
      ]);
    }
}
