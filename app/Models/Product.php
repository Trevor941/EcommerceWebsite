<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'products';
    protected $fillable = ['name', 'SKU', 'regularprice', 'saleprice', 'description', 'stock', 'product_sizes_id', 'product_colors_id','quantity', 'featuredimage', 'deleted_at'];

    public function Color(){
        return $this->belongsTo(Color::class);
    }

    public function size(){
        return $this->belongsTo(Size::class);
    }

    public function ProductStatus(){
        return $this->belongsTo(ProductStatus::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_product');
    }


    public function galleryimages(){
        return $this->hasMany(Gallery::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
    // public function searchbycategory(){
    //     return $this->categories()->wherePivot('category_id', 3);
    // }
}
