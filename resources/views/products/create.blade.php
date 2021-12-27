@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 header">
        <h3 class="preview-h">Add Product</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <h3 class="product-detail">Product Details</h3>
        <div>
            @if($errors->any())
            <ul>
            @foreach ($errors->all() as $error)
            <li style="color:red;">{{$error}}</li>
            @endforeach
            </ul>
            @endif
        </div>
            <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="addproduct">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Product SKU</label>
                        <input type="text" class="form-control" name="SKU">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Regular Price</label>
                        <input type="text" class="form-control" name="regularprice" id="regularprice">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Sale Price (Optional)</label>
                        <small id="errorsaleprice" class="text-danger" hidden>Sale price should be less than regular price</small>
                        <input type="text" class="form-control" name="saleprice" id="saleprice">
                    </div>
                </div>
               
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Description</label>
                        <textarea class="ckeditor form-control" name="description" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Stock (Optional)</label>
                        <input type="number" class="form-control" name="stock" min="1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Product Size</label>
                    <select class="form-control" name="product_sizes_id">
                        <option value="">--Select--</option>
                        @foreach ($productsizes as $productsize)
                        <option value="{{$productsize->id}}">{{$productsize->size}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
               <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Tags (Optional)</label>
                    <input type="text" class="form-control" name="tags" placeholder="tag1, tag3, tag3"/>
                    
                </div>
                <div class="form-group col-md-6">
                    <label for="">Status</label>
                    <select class="form-control" name="published">
                        <option value="1">Published</option>
                        <option value="0">Draft</option>
                    </select>
                </div>
               </div>
               <div class="row p-3">
                <label for="">Product Color</label><br>
                <div class="form-group col-md-12 darkerlightbg">
                   @foreach ($productcolors as $productcolor)
                   <div class="form-check-inline" style="margin-right: 30px;">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" value="{{$productcolor->id}}" name="product_colors_id">{{$productcolor->color}}
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
                          <input type="checkbox" class="form-check-input" value="{{$category->id}}" name="categories[]">{{$category->name}}
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
                    <button class="btn btn-block btn-primary" id="submitProduct" type="submit">Save</button>
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
// $(document).ready(function(){
//     $("#submitProduct").removeAttr("disabled");
//     $("#saleprice").change(function(){
//         $saleprice = $("#saleprice").val();
//         $regularprice = $("#regularprice").val();
//         if($saleprice > $regularprice){
//         $("#errorsaleprice").prop("hidden", false);
//         $("#submitProduct").prop("disabled", true);
//     }else{
//         $("#errorsaleprice").prop("hidden", true);
//         $("#submitProduct").prop("disabled", false);
//     }
// })
// $("#regularprice").change(function(){
//         $saleprice = $("#saleprice").val();
//         $regularprice = $("#regularprice").val();
//         if($saleprice > $regularprice){
//         $("#errorsaleprice").prop("hidden", false);
//         $("#submitProduct").prop("disabled", true);
//     }else{
//         $("#errorsaleprice").prop("hidden", true);
//         $("#submitProduct").prop("disabled", false);
//     }
// })
})
</script>
@endsection