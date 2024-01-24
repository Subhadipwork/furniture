<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'subcategory','productimage'];
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
    public function productimage(){
        return $this->hasMany(ProductImage::class);
    }
    
}
