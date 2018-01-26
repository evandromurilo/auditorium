<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('periods')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Manhã 1',
				'beginning' => '07:00',
				'end' => '09:30',
			]);

			DB::table('periods')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Manhã 2',
				'beginning' => '09:30',
				'end' => '12:00',
			]);

			DB::table('periods')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Tarde',
				'beginning' => '13:00',
				'end' => '15:30',
			]);

			DB::table('periods')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Tarde 2',
				'beginning' => '15:30',
				'end' => '17:30',
			]);

			DB::table('periods')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Intermediário',
				'beginning' => '17:30',
				'end' => '19:00',
			]);

			DB::table('periods')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Noite 1',
				'beginning' => '19:00',
				'end' => '20:30',
			]);

			DB::table('periods')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Noite 2',
				'beginning' => '20:30',
				'end' => '22:00',
			]);
    }
}
