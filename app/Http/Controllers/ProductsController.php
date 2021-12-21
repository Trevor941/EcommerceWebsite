<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductStatus;
use App\Models\FeaturedImage;
use App\Models\ProductGallery;
use App\Models\Tag;
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
        //form fields from a request
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
         
         //adding a featured image
        if($request->hasFile('featuredimage')){
                $imageName = $request->name.time().'.'.$request->featuredimage->extension();
                $path = $request->file('featuredimage')->move('images', $imageName);
                 $product->featuredimage = $imageName;
        }
        $product->save();

        //adding product category
        $product->categories()->sync($request->categories);

        //getting string of tags and converting it into an array
        $explode_tags = explode(',', $request->tags);

        //initializing tagids array
        $tagids = array();

        //checking if a tag name exist and adding it if it doesn't exist
        foreach($explode_tags as $tagname){
            $checktag = Tag::where('name', $tagname)->first();
            if($checktag === null){
                $newtag = new Tag();
                $newtag->name = $tagname;
                $newtag->save();
                $tagid = $newtag->id;
            }else{
                $tagid = $checktag->id;
            }
            //pushing all ids to the tagsid array
            array_push($tagids, $tagid);
         }
            //assigning tags to a product
         $product->tags()->sync($tagids);
        // return $tagids;

      // adding multiple gallery images
        if($request->hasFile('galleryimages')){
            foreach($request->galleryimages as $image){
                $imageName = $request->name.uniqid().'.'.$image->extension();
                $path = $image->move('images', $imageName);
                $gallery = new ProductGallery();
                $gallery->name = $imageName;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
       return redirect(route('products.create'))->with('success', 'New product created successfully');
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
    public function edit(Product $product)
    {
        $productcolors = ProductColor::all();
        $categories = Category::all();
        $productsizes = ProductSize::all();
        $productstatuses = ProductStatus::all();
        $tags = Tag::all();
        return view('products.edit', compact(['product','productcolors', 'categories', 'productsizes', 'productstatuses', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
         $product->SKU = $request->SKU;
         $product->regularprice = $request->regularprice;
         $product->saleprice = $request->saleprice;
         $product->description = $request->description;
         $product->stock = $request->stock;
         $product->product_sizes_id = $request->product_sizes_id;
         $product->product_colors_id = $request->product_colors_id;
         $product->product_status_id = $request->product_status_id;
         
         //adding a featured image
        if($request->hasFile('featuredimage')){
                $imageName = $request->name.time().'.'.$request->featuredimage->extension();
                $path = $request->file('featuredimage')->move('images', $imageName);
                 $product->featuredimage = $imageName;
        }
        $product->update();

        //adding product category
        $product->categories()->sync($request->categories);

        //getting string of tags and converting it into an array
        $explode_tags = explode(',', $request->tags);

        //initializing tagids array
        $tagids = array();

        //checking if a tag name exist and adding it if it doesn't exist
        foreach($explode_tags as $tagname){
            $checktag = Tag::where('name', $tagname)->first();
            if($checktag === null){
                $newtag = new Tag();
                $newtag->name = $tagname;
                $newtag->save();
                $tagid = $newtag->id;
            }else{
                $tagid = $checktag->id;
            }
            //pushing all ids to the tagsid array
            array_push($tagids, $tagid);
         }
            //assigning tags to a product
         $product->tags()->sync($tagids);
        // return $tagids;

      // adding multiple gallery images
        if($request->hasFile('galleryimages')){
            foreach($request->galleryimages as $image){
                $imageName = $request->name.uniqid().'.'.$image->extension();
                $path = $image->move('images', $imageName);
                $gallery = new ProductGallery();
                $gallery->name = $imageName;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
       return redirect(route('products.edit'))->with('success', 'Product updated successfully');
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
