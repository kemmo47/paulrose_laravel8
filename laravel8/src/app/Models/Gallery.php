<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'gallery_image','product_id', 'gallery_color','gallery_title'
    ];
    protected $primaryKey = 'gallery_id';
    protected $table = 'tbl_gallery_product';

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
