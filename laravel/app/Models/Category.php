<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function product($relation)
    {
        return $this->hasMany(Product::class , 'categories_name' , 'id');
    }

    public $timestamps = false;
}
