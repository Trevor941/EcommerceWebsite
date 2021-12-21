<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'products';
    protected $fillable = ['name', 'SKU', 'regularprice', 'saleprice', 'description', 'stock', 'product_sizes_id', 'product_colors_id', 'product_status_id', 'featuredimage'];

    public function ProductColor(){
        return $this->belongsTo(ProductColor::class);
    }

    public function ProductSize(){
        return $this->belongsTo(ProductSize::class);
    }

    public function ProductStatus(){
        return $this->belongsTo(ProductStatus::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function featuredimages(){
        return $this->hasMany(FeaturedImage::class);
    }

    public function productgalleries(){
        return $this->hasMany(ProductGallery::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
    
}
