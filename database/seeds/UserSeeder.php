<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Rexx Admin',
            'email' => 'rexx.admin@getnada.com',
            'password' => Hash::make('Password@123'),
        ]);
    }
}
