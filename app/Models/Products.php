<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Opis\Closure\SecurityException;

class Products extends Model
{
    use HasFactory;
    static $tableName = 'products';

    public static function getProductsByID($ids) {
        return DB::table(self::$tableName)->select('product_id','price')->whereIn('product_id',$ids)->get();
    }
}
