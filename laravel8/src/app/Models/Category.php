<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'category_name','category_desc', 'category_image'
    ];
    protected $primaryKey = 'category_id';
    protected $table = 'tbl_category_product';

    public function subcategory(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }
    public function product(){
        return $this->hasMany(Product::class, 'category_id');
    }
}
