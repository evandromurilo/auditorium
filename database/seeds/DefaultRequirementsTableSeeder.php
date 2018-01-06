<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DefaultRequirementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('default_requirements')->insert([
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Reitor',
			]);

			DB::table('default_requirements')->insert([
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Capelão',
			]);

			DB::table('default_requirements')->insert([
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Datashow',
			]);

			DB::table('default_requirements')->insert([
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Computador',
			]);

			DB::table('default_requirements')->insert([
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Mesa de Honra',
			]);
    }
}
