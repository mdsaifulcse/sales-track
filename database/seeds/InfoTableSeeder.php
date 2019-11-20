<?php

use Illuminate\Database\Seeder;

class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_info')->insert([
            'company_name' => 'My Company',
            'logo' => 'images/default/logo.png',
            'favicon' => 'images/default/favicon.png',
            'address1' => 'Dhaka, Bangladesh',
            'mobile' => '01000000000',
            'type' => 1,
            'email' => 'admin@gmail.com',
        ]);
    }
}
