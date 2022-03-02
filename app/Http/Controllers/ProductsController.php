<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Category;
use App\Models\Size;
use App\Models\FeaturedImage;
use App\Models\Gallery;
use App\Models\Tag;
use App\Models\Role;
use App\Http\Requests\ProductValidateRequest;
use App\Http\Requests\BulkActionRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function  __construct(){
       $this->middleware('admin');
      
    }
    public function index(Request $request)
    {
        $searchproduct = request()->query('searchresult');
        $searchdraft = request()->query('draft');
        $searchpublished = request()->query('published');
        $selectedcategory = request()->query('selectedcategory');
        $selectedstock = request()->query('selectedstock');
        if($searchdraft){
            $products = Product::where('published', 'LIKE', "0")->paginate(6);
        }
        else if($searchpublished){
            $products = Product::where('published', 'LIKE', "1")->paginate(6);  
        }
        else if($searchproduct){
            $products = Product::where('name', 'LIKE', "%{$searchproduct}%")->paginate(6);  
        }
        else if($selectedstock == '1' && $selectedcategory != null){
            $products = Product::where('stock', '>=', 10 )->whereHas('categories', function($query) use ($request){
                $query->where('category_id', $request->selectedcategory);
            })->paginate(6);
        }
        else if($selectedstock == '2' && $selectedcategory != null){
            $products = Product::whereBetween('stock', [1, 10])->whereHas('categories', function($query) use ($request){
                $query->where('category_id', $request->selectedcategory);
            })->paginate(6);
        }
        else if($selectedstock == '3' && $selectedcategory != null){
            $products = Product::where('stock', 0)->whereHas('categories', function($query) use ($request){
                $query->where('category_id', $request->selectedcategory);
            })->paginate(6);
        }
        else if($selectedstock == '1'){
            $products = Product::where('stock', '>=', 10 )->paginate(6);
        }
        else if($selectedstock == '2'){
            $products = Product::whereBetween('stock', [1, 10])->paginate(6);
        }
        else if($selectedstock == '3'){
            $products = Product::where('stock', 0)->paginate(6);
        }
        else if($selectedcategory){
            $products = Product::whereHas('categories', function($query) use ($request){
                $query->where('category_id', $request->selectedcategory);
            })->paginate(6);
        }
        else {
            $products = Product::paginate(6); 
        }

        $withTrashed = Product::withTrashed()->get();
        $AllTrashedProducts = Product::onlyTrashed()->get();
        $categories = Category::all();
        $published = Product::where('published', 1);
        $draft = Product::where('published', 0);
       return view('products.index', compact(['products', 'categories', 'published', 'draft', 'AllTrashedProducts', 'withTrashed']));
            
    }

    
    // public function searchbycategory(){
    //     $var = request()->query('selectedcategory');
    //     return gettype($var);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productcolors = Color::all();
        $categories = Category::all();
        $productsizes = Size::all();
        return view('products.create', compact(['productcolors', 'categories', 'productsizes']));
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
         $product->published = $request->published;
         $product->quantity = 1;
         //adding a featured image
        if($request->hasFile('featuredimage')){
                $imageName = $request->name.time().'.'.$request->featuredimage->extension();
                $path = $request->file('featuredimage')->move('images/featuredimg', $imageName);
                 $product->featuredimage = $imageName;
                 $img = Image::make($path);
                 $img->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($path);
        }
       

        $product->save();

        //adding product category
        $product->categories()->sync($request->categories);

        //getting string of tags and converting it into an array
        if($request->tags){

        
        $explode_tags = explode(',', $request->tags);
  
        //initializing tagids array
        $tagids = array();

        //checking if a tag name exist and adding it if it doesn't exist
        foreach($explode_tags as $tagname){
            $checktag = Tag::where('name', $tagname)->first();
            if($checktag !== null){
                $tagid = $checktag->id;
            }
            else{
                $newtag = new Tag();
                $newtag->name = $tagname;
                $newtag->save();
                $tagid = $newtag->id;
            }
            //pushing all ids to the tagsid array
            array_push($tagids, $tagid);
         }
            //assigning tags to a product
         $product->tags()->sync($tagids);
        // return $tagids;
    }
      // adding multiple gallery images
        if($request->hasFile('galleryimages')){
            foreach($request->galleryimages as $image){
                $imageName = $request->name.uniqid().'.'.$image->extension();
                $path = $image->move('images/galleryimages', $imageName);
                $gallery = new Gallery();
                $gallery->name = $imageName;
                $gallery->product_id = $product->id;
                $gallery->save();

                $img = Image::make($path);
                 $img->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($path);
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
        $productcolors = Color::all();
        $categories = Category::all();
        $productsizes = Size::all();
        $tags = Tag::all();
        $galleries = Gallery::all();
        return view('products.edit', compact(['product','productcolors', 'categories', 'productsizes', 'tags', 'galleries']));
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
         $product->published = $request->published;
         $product->quantity = 1;
         //adding a featured image
        if($request->hasFile('featuredimage')){
               $file =  public_path()."/images/featuredimg/".$product->featuredimage;
            if(file_exists($file)){
                File::delete(public_path()."/images/featuredimg/".$product->featuredimage);
              }
                $imageName = $request->name.time().'.'.$request->featuredimage->extension();
                $path = $request->file('featuredimage')->move('images/featuredimg', $imageName);
                 $product->featuredimage = $imageName;
                 $img = Image::make($path);
                 $img->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($path);
        }
        $product->update();

        //adding product category
        $product->categories()->sync($request->categories);

        //getting string of tags and converting it into an array
       if($request->tags){
        $explode_tags = explode(',', $request->tags);

        //initializing tagids array
        $tagids = array();

        //checking if a tag name exist and adding it if it doesn't exist
        foreach($explode_tags as $tagname){
            $checktag = Tag::where('name', $tagname)->first();
            
            if($checktag !== null){
                $tagid = $checktag->id;
            }
            else{
                $newtag = new Tag();
                $newtag->name = $tagname;
                $newtag->save();
                $tagid = $newtag->id;
            }
            //pushing all ids to the tagsid array
            array_push($tagids, $tagid);
         }
            //assigning tags to a product
         $product->tags()->sync($tagids);
        // return $tagids;
    }
    

    
    if($request->inimages){
        $product->galleryimages()->delete();
        $filename = '';
        $path = public_path('images/galleryimages');
        $allFiles = File::allFiles($path); 
      
           foreach($request->inimages as $reqimage){
                $newimage = new Gallery();
                $newimage->name = $reqimage;
                $newimage->product_id = $product->id;
                $newimage->save();
               }
               
               foreach($allFiles as $filee){
                $filename = $filee->getFileName();
                $checkfilenamexists = Gallery::where('name', $filename)->first();
               if($checkfilenamexists === null){
                   
                   File::delete(public_path()."/images/galleryimages/".$filename);
              }
            }
        }
        else{
             $product->galleryimages()->delete();
             $filename = '';
             $path = public_path('images/galleryimages');
             $allFiles = File::allFiles($path); 
             foreach($allFiles as $filee){
                $filename = $filee->getFileName();
                $checkfilenamexists = Gallery::where('name', $filename)->first();
               if($checkfilenamexists === null){
                   
                   File::delete(public_path()."/images/galleryimages/".$filename);
              }
            }
            }
        

      // adding multiple gallery images unlink( public_path()."/images/".$gimage->name);
        if($request->hasFile('galleryimages')){
            foreach($request->galleryimages as $image){
                $imageName = $request->name.uniqid().'.'.$image->extension();
                $path = $image->move('images/galleryimages', $imageName);
                $gallery = new Gallery();
                $gallery->name = $imageName;
                $gallery->product_id = $product->id;
                $gallery->save();
                $img = Image::make($path);
                $img->resize(null, 300, function ($constraint) {
                   $constraint->aspectRatio();
               });
               $img->save($path);

            }
        }
    return redirect(route('products.edit', $product->id ))->with('success', 'Product updated successfully');
      
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

    public function trashProduct($id){
        Product::findOrFail($id)->delete();
        return redirect(route('products.index'));
    }

    public function deleteProduct($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $filepath = public_path()."images/featuredimg".$product->featuredimage;
        if(file_exists($filepath)){
        unlink( $filepath);
        }
        $galleryimages = Gallery::all();
        foreach($galleryimages as $galleryimage){
            if($galleryimage->product_id === $product->id){
                $filepath = public_path()."images/galleryimages".$galleryimage->name;
        if(file_exists($filepath)){
        unlink( $filepath);
        }
            }
        }
        $product->forceDelete();
        return redirect(route('products.index'));
    }
    public function restoreProduct($id){
        Product::onlyTrashed()->findOrFail($id)->restore();
        return redirect(route('products.index'));
    }

    public function restoreAllProducts(){
        Product::withTrashed()->restore();
        return redirect(route('products.index'));
    }

    public function AllTrashedProducts(){
        
        $withTrashed = Product::withTrashed()->get();
        $AllTrashedProducts = Product::onlyTrashed()->paginate(6);
        $trashcount = Product::onlyTrashed()->get();
        $categories = Category::all();
        $published = Product::where('published', 1);
        $draft = Product::where('published', 0);
        return view('products.trash', compact(['AllTrashedProducts', 'trashcount', 'categories', 'published', 'draft', 'withTrashed']));
    }


    // public function useroles(){

    //   //  $role = Role::findOrFail($id);
    //   $user = auth()->user();
        

    //     if(auth()->user()->roles->contains('name', 'Admin')){
    //         return 'true';
    //        }
    //        else{
    //         return redirect('/login');
    //        }
    // }


    public function bulkactionsproducts(BulkActionRequest $request){
        if($request->selectedaction === '2'){
            foreach($request->product_ids as $product_id){
                Product::findOrFail($product_id)->delete();
            }
            return redirect(route('products.index'))->with('success', 'Products deleted successfully');
        }
       
    }

    public function bulkactionstrash(BulkActionRequest $request){
       
        
        if($request->selectedaction === '1'){
            foreach($request->product_ids as $product_id){
                $product = Product::onlyTrashed()->findOrFail($product_id);
                $filepath = public_path()."images/featuredimg".$product->featuredimage;
                if(file_exists($filepath)){
                unlink( $filepath);
                }
                $galleryimages = Gallery::all();
                foreach($galleryimages as $galleryimage){
                    if($galleryimage->product_id === $product->id){
                        $filepath = public_path()."images/galleryimages".$galleryimage->name;
                if(file_exists($filepath)){
                unlink( $filepath);
                }
                    }
                }
                $product->forceDelete();
            }
            return redirect(route('products.index'))->with('success', 'Products deleted successfully');
        }
       if($request->selectedaction === '2'){
            foreach($request->product_ids as $product_id){
                Product::onlyTrashed()->findOrFail($product_id)->restore();
            }
            return redirect(route('products.index'))->with('success', 'Products restored successfully');
        }
       
    }
}
