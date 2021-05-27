<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $insertData =[
            [
                'id' => 1,
                'user_id' => 15,
                'product_id' => 2,
                'quantity' => 3,
            ],
            [
                'id' => 2,
                'user_id' => 15,
                'product_id' => 5,
                'quantity' => 3,
            ],
            [
                'id' => 3,
                'user_id' => 15,
                'product_id' => 1,
                'quantity' => 1,
            ]
        ];
        DB::table('cart')->insert($insertData);
    }
}
