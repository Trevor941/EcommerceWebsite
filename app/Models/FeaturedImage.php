<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'featured_images';
    protected $fillable = ['name', 'product_id'];
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
