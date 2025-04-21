<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name'  => 'Gerardo Cabello',
            'email'     => 'smireles@cotisap.com',
            'password' => Hash::make('root')
        ]);
    }
}
