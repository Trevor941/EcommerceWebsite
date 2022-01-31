<?php

namespace App\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Models\Product;

class ProductComposer
{
   
    public function compose(View $view)
    {
        $view->with('products', Product::all());
    }
}