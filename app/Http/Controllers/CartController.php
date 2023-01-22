<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){
        $cart = Cart::all();
        return view('admin.service.cart',compact('cart'));
        
    }
    public function tocart($id){
        //$cart = Cart::all();
        $product = Product::find($id);
        $user = User::find($id);
        $cart = new Cart;
        $cart -> cart_name = $product -> product_name;
        $cart -> cart_price = $product -> product_price;
        $cart -> cart_image = $product -> product_image;
        $cart -> cart_user = Auth::user() -> name;
        $cart -> save();
        // Cart::insert([
        //     'cart_name' => Product::name() -> product_name,
        //     'cart_image' => Product::image() -> product_image,
        //     'cart_price' => Product::price() -> product_price,
        // ]);
        return redirect() -> route('services');
    }
    public function softdelete($id){
        $delete = Cart::find($id) -> forceDelete();
        return redirect() -> back() -> with('success', "ลบข้อมูลเรียบร้อย");
    }
}
