<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductStatus;
use App\Models\FeaturedImage;
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
    public function store(Request $request)
    {
           $data = $this->validate($request, [
            'name' => 'required|min:3|max:28',
            'SKU' => 'required',
            'regularprice' => 'required',
            'saleprice' => '',
            'description' => '',
            'stock' => '',
            //'tags' => '',
            'product_sizes_id' => 'required',
            'product_colors_id' => 'required',
            'product_status_id' => 'required',
            'categories' => 'required',
            'images' => 'required'

         ]);
         $product = new Product();
         $datainput = $request->all();
        // if($request->hasFile('image')){
        //         $imageName = $request->name.time().'.'.$request->image->extension();
        //         $path = $request->file('image')->move('images', $imageName);
        //          $datainput['image'] = $imageName;
        // }
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imageName = $request->name.time().'.'.$image->extension();
               $path = $image->move('images', $imageName);
               $product->featuredimages()->name[] = $imageName;
               
            }
            
            

        }return $imageName;
        $product->create(
            $datainput
        )->categories()->attach($request->categories);
       
    
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
