<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductStatus;
use App\Models\FeaturedImage;
use App\Http\Requests\ProductValidateRequest;
use Illuminate\Support\Str;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productcolors = ProductColor::all();
        $categories = Category::all();
        $productsizes = ProductSize::all();
        $productstatuses = ProductStatus::all();
        return view('products.create', compact(['productcolors', 'categories', 'productsizes', 'productstatuses']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidateRequest $request)
    {
         $product = new Product();
         $product->name = $request->name;
         $product->SKU = $request->SKU;
         $product->regularprice = $request->regularprice;
         $product->saleprice = $request->saleprice;
         $product->description = $request->description;
         $product->stock = $request->stock;
         $product->product_sizes_id = $request->product_sizes_id;
         $product->product_colors_id = $request->product_colors_id;
         $product->product_status_id = $request->product_status_id;
        if($request->hasFile('featuredimage')){
                $imageName = $request->name.time().'.'.$request->featuredimage->extension();
                $path = $request->file('featuredimage')->move('images', $imageName);
                 $product->featuredimage = $imageName;
        }
        $product->save();
        $product->categories()->sync($request->categories);
        return $request->all();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
