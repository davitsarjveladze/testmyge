<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insertData= [];
        for ($i = 1; $i < 16 ; $i++ ){
            $insertData[] = [
                'name' => 'testUser' . $i ,
                'email' => 'testUser' . $i .'@gmail.com',
                'password' => Hash::make('password'),
            ];
        }
        DB::table('users')->insert($insertData);
    }
}
