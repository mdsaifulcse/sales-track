<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Developer',
            'email' => 'dev@gmail.com',
            'password' => bcrypt('12345678'),
            'mobile'=>'01829655974',
            'type'=>1,
            'created_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678'),
            'mobile'=>'01687835849',
            'type'=>1,
            'created_at'=>date('Y-m-d')
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'mobile'=>'01700000000',
            'type'=>1,
            'created_at'=>date('Y-m-d')
        ]);
    }
}
