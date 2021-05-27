<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addProductInCart(Request $request) {
        $request->validate([
            'product_id' => 'required|integer',
        ]);
        return Cart::addProductInCart([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id
        ]);
    }

    public function removeProductFromCart(Request $request) {
        $request->validate([
            'product_id' => 'required|integer',
        ]);
        return cart::removeProductFromCart(Auth::id(),$request->product_id);
    }

    public function setCartProductQuantity(Request $request) {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);
        return cart::setCartProductQuantity(Auth::id(),$request->product_id,$request->quantity);
    }

    public function getUserCart() {
        $cart = Cart::getUserCart(Auth::id());
        return ['products' => $cart,'discount' => $this->getTotalDiscountSum($cart)];
    }

    private function getTotalDiscountSum($cart) {
        $objCart = [];
        $totalDiscount =0;
        $productsIDArray = [];
        $discounts = $this->getDiscounts();


        foreach ($cart as $item) {
            $objCart[$item->product_id] = $item;
            $productsIDArray[] = $item->product_id;
        }

        foreach ($discounts as $disc) {
            if ($this->IsSubArray($productsIDArray,$disc['products'])) {
                $totalDiscount  += $this->getDiscountSum($objCart,$disc) ;
            }
        }
        return $totalDiscount;
    }


    private function getProductsIdArrayAndCartObject($cart) {

    }

    private function getDiscounts() {
        $rawDiscount = Discount::getDiscounts();
        $discounts = [];
        foreach ($rawDiscount as $arr) {
            if (isset($discounts[$arr->group_id])) {
                $discounts[$arr->group_id]['products'][] = $arr->product_id;
            }
            else {
                $discounts[$arr->group_id] = [
                    'products' => [$arr->product_id],
                    'discount' =>  $arr->discount
                ];
            }
        }
        return $discounts;
    }

    private function IsSubArray($mainArray,$subArray) {
        $i = 0;
        foreach ($subArray as $item) {
            if (in_array($item,$mainArray)) {
                $i += 1;
                continue;
            } else {
                return false;
            }
        }
        if ($i === count($subArray)) {
            return true;
        }
         return  false;
    }
    private function getDiscountSum($products,$discount) {
        $priceList = [];
        $quantityList = [];
        foreach ($discount['products'] as $id) {
            $priceList[]    = $products[$id]->price;
            $quantityList[] = $products[$id]->quantity;
        }
        return (array_sum($priceList) * min($quantityList) * $discount['discount'])/100 ;
    }
}
