<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Discount extends Model
{
    use HasFactory;
    static $tableName = 'user_product_groups';
    static $subTableName = 'product_group_items';

    public static function getDiscounts() {

//       return DB::select('SELECT  user_id, discount,
//          (SELECT product_id FROM product_group_items
//          WHERE product_group_items.group_id = user_product_groups.group_id) AS products
//          FROM user_product_groups;');
        $GroupsItems = DB::table('product_group_items')->select('group_id','product_id');
        return DB::table('user_product_groups')
            ->joinSub($GroupsItems, 'latest_posts', function ($join) {
                $join->on('user_product_groups.group_id', '=', 'latest_posts.group_id');
            })->get();
    }

}
