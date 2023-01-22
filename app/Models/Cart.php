<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Product;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cart_name',
        'cart_image',
        'cart_price',
        'cart_user'
    ];

    public function user(){
        return $this -> hasOne(User::class,'id','user_id','name');
    }
}
