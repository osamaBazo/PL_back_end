<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static orderBy(string $string, string $string1)
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name' ,
        'price' ,
        'description',
        'quantity',
        'first_discount',
        'second_discount',
        'third_discount',
        'first_price',
        'second_price',
        'third_price',
        //'categories_name',
        //'users_id',
        'expired_date'
    ];


    public function categories()
    {
        return $this->belongsTo(Category::class,'categories_name' );
    }
}
