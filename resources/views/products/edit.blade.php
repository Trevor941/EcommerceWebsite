@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 header">
        <h3 class="preview-h">Edit Product</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <h3 class="product-detail">Edit Product Details</h3>
        <div>
            @if($errors->any())
            <ul>
            @foreach ($errors->all() as $error)
            <li style="color:red;">{{$error}}</li>
            @endforeach
            </ul>
            @endif
        </div>
            <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data" id="addproduct">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Product SKU</label>
                        <input type="text" class="form-control" name="SKU" value="{{$product->SKU}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Regular Price</label>
                        <input type="text" class="form-control" name="regularprice" id="regularprice" value="{{$product->regularprice}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Sale Price (Optional)</label>
                        <small id="errorsaleprice" class="text-danger" hidden>Sale price should be less than regular price</small>
                        <input type="text" class="form-control" name="saleprice" id="saleprice" value="{{$product->saleprice}}">
                    </div>
                </div>
               
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Description</label>
                        <textarea class="ckeditor form-control" name="description" id="" cols="30" rows="10">{{$product->description}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Stock (Optional)</label>
                        <input type="number" class="form-control" name="stock" min="1" value="{{$product->stock}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Product Size</label>
                    <select class="form-control" name="product_sizes_id">
                        
                        @foreach ($productsizes as $productsize)
                        <option value="{{$productsize->id}}" 
                            @if ($productsize->id === $product->product_sizes_id)
                            selected 
                         @endif
                            >
                            {{$productsize->size}}
                        </option>
                        @endforeach
                    </select>
                    </div>
                </div>
               <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Tags (Optional)</label>
                    <input type="text" class="form-control" name="tags" placeholder="tag1, tag3, tag3"
                    value="@foreach($product->tags as $tag){{$tag->name}},@endforeach " />
                </div>
                <div class="form-group col-md-6">
                    <label for="">Status</label>
                    <select class="form-control" name="product_status_id">
                        <option value="">--Select--</option>
                        @foreach ($productstatuses as $productstatus)
                        <option value="{{$productstatus->id}}"
                            @if ($productstatus->id === $product->product_status_id)
                            selected 
                         @endif
                            >{{$productstatus->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
               </div>
               <div class="row p-3">
                <label for="">Product Color</label><br>
                <div class="form-group col-md-12 darkerlightbg">
                   @foreach ($productcolors as $productcolor)
                   <div class="form-check-inline" style="margin-right: 30px;">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" value="{{$productcolor->id}}" name="product_colors_id"
                      @if ($productcolor->id === $product->product_colors_id)
                      checked 
                   @endif
                      >{{$productcolor->color}}
                    </label>
                  </div>
                   @endforeach
                </div>
               </div>
               <div class="row p-3">
                <label for="">Product Category</label><br>
               <div class="form-group col-md-12 darkerlightbg">
                    @foreach ($categories as $category)
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="{{$category->id}}" name="categories[]"
                          @foreach ($product->categories as $procategory)
                          @if ($category->id === $procategory->id)
                          checked 
                        @endif
                          @endforeach
                          >{{$category->name}}
                        </label>
                      </div>
                    @endforeach
                  </div>
                 </div>
               <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Product Image</label>
                    <input type="file" class="form-control" name="featuredimage" id="file"/>
                </div>
               </div>
               <div class="row">
                <div class="form-group col-md-12">
                    <label for="">Product Gallery Images</label>
                    <input type="file" class="form-control" name="galleryimages[]" id="file" multiple/>
                </div>
               </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" id="submitProduct" type="submit" disabled>Save</button>
                </div>
            </form>
    </div>
    <div class="col-md-4">
        <h3 class="product-image">Product Image</h3>
        <div class="row">
            <p id="previeww">

            </p>
        </div>
    </div>
</div>
<style>
    #addproduct{
      padding: 20px;
    background: #fff;
    margin-bottom: 20px;
    }
    .darkerlightbg{
  background: #f8f9fc;
    padding: 10px;
    border-radius: 5px; 
    }
    
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection