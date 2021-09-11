<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'subcategory_name','category_id','subcategory_image'
    ];
    protected $primaryKey = 'subcategory_id';
    protected $table = 'tbl_subcategory';

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function product(){
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}
