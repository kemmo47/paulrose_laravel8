<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'product_name','product_price','product_desc','product_ingredient','product_slug','category_id','subcategory_id'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function gallery(){
        return $this->hasMany(Gallery::class, 'product_id');
    }

    public function onegallery(){
        return $this->hasOne(Gallery::class, 'product_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
}
