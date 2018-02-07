<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('calls')->insert([
                'id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'title' => 'Chat',
                'user_to_user' => false
            ]);
    }
}
