<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AuditoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('auditoria')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Auditório A',
				'capacity' => 300,
				'accessible' => true,
				'obs' => NULL,
				'location' => 'Prédio A',
			]);

			DB::table('auditoria')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Mini Auditório A',
				'capacity' => 80,
				'accessible' => true,
				'obs' => NULL,
				'location' => 'Prédio A',
			]);

			DB::table('auditoria')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Mini Auditório B',
				'capacity' => 100,
				'accessible' => true,
				'obs' => NULL,
				'location' => 'Prédio B',
			]);

			DB::table('auditoria')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Mini Auditório C1',
				'capacity' => 120,
				'accessible' => false,
				'obs' => NULL,
				'location' => 'Prédio C',
			]);

			DB::table('auditoria')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Mini Auditório C2',
				'capacity' => 120,
				'accessible' => false,
				'obs' => NULL,
				'location' => 'Prédio C',
			]);
    }
}
