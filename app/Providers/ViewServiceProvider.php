<?php

namespace App\Providers;

use App\View\Composers\ProductComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Tag;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
      //  View::composer('store.index', ProductComposer::class);

        // Using closure based composers...
        View::composer('store.index', function ($view) {
            $view->with('recentproducts', Product::orderBy('created_at', 'DESC')->limit(6)->get());
        });

        View::composer('store.index', function ($view) {
            $view->with('featuredproducts', Product::all()->random(6));
        });
        View::composer('store.products', function ($view) {
            $view->with('allproducts', Product::paginate(6));
        });

        View::composer('store.partials.storesidebar', function ($view) {
            $view->with('alltags', Tag::all());
        });
        View::composer('store.partials.storesidebar', function ($view) {
            $view->with('sliderproducts', Product::all());
        });

        View::composer('store.productdetail', function ($view) {
            $view->with('relatedproducts', Product::all()->random(3));
        });
      
      
    }
}