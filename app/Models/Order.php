<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = ['firstname', 'lastname', 'email', 'orderstatuses_id', 'city', 'address', 'country', 'phone', 'date', 'cost'];
    public function orderstatuses(){
        return $this->belongsTo(OrderStatus::class);
    }
}
