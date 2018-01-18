<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$user = User::create([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Aemilia',
				'email' => 'aemilia@mail.com',
				'password' => bcrypt('123456'),
				'color' => '#E60474',
				'cel' => '(69) 9999-9990',
				'description' => 'A chefe.',
			]);
      $user->assign('admin');

			$user = User::create([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Iulia',
				'email' => 'iulia@mail.com',
				'password' => bcrypt('123456'),
				'color' => '#e5aff7',
				'cel' => '(69) 9999-9991',
				'description' => 'Filha da chefe.',
			]);
      $user->assign('secre');

			DB::table('users')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Iulius',
				'email' => 'iulius@mail.com',
				'password' => bcrypt('123456'),
				'color' => '#8529CF',
				'cel' => '(69) 9999-9992',
				'description' => 'Marido da chefe.',
			]);

			DB::table('users')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Marcus',
				'email' => 'marcus@mail.com',
				'password' => bcrypt('123456'),
				'color' => '#DA0905',
				'cel' => '(69) 9999-9993',
				'description' => 'Filho mais velho da chefe.',
			]);

			DB::table('users')->insert([
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'name' => 'Quintus',
				'email' => 'quintus@mail.com',
				'password' => bcrypt('123456'),
				'color' => '#e8d16d',
				'cel' => '(69) 9999-9994',
				'description' => 'Filho mais novo da chefe.',
			]);

			$call = \App\Call::find(1);

			foreach (\App\User::all() as $user) {
				event(new \App\Events\UserRegistered($user));
			}
    }
}
