<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGroupItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insertData =[
            [
                'item_id' => 1,
                'group_id' => 15,
                'product_id' => 2,
            ],
            [
                'item_id' => 2,
                'group_id' => 15,
                'product_id' => 5,
            ],
        ];
        DB::table('product_group_items')->insert($insertData);
    }
}
