<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;
    static $tableName = 'cart';
    static $productsTableName = 'products';

    public static function getUserCart($userID) {
       return DB::table(self::$tableName)->where(self::$tableName.'.user_id' ,'=' ,$userID)
           ->join(self::$productsTableName, self::$tableName.'.product_id', '=', self::$productsTableName.'.product_id')
           ->select([
               self::$tableName.'.product_id',
               self::$tableName.'.quantity',
               self::$productsTableName.'.price'
       ])->get();
    }

    public static function addProductInCart($data) {
        if (!DB::table(Cart::$tableName)->where($data)->exists())
            return DB::table(Cart::$tableName)->insert($data);
        return false;
    }
    public static function removeProductFromCart($user_id,$product_id) {
        return DB::table(Cart::$tableName)->where('user_id','=' ,$user_id)
            ->where('product_id','=' ,$product_id)
            ->delete();
    }
    public static function setCartProductQuantity($user_id,$product_id,$quantity) {
        if (DB::table(Cart::$tableName)->where(['user_id'=>$user_id,'product_id' =>$product_id])->exists())
            return DB::table(Cart::$tableName)
                ->where(['user_id'=>$user_id,'product_id' =>$product_id])
                ->update(['quantity' => $quantity]);
        return false;
    }
}
