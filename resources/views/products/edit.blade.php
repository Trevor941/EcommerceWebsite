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
                      <input type="radio" class="form-check-input" value="{{$productcolor->id}}" name="product_colors_id"
                      @if ($productcolor->id === $product->product_colors_id)
                      checked 
                   @endif
                      >{{$productcolor->name}}
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

               <div class="row p-3">
                <label for="">Product Image</label><br>
                <div class="form-group col-md-12 darkerlightbg">
                    @if (file_exists('images/featuredimg/'. $product->featuredimage) )
                    <img class="m-1 p-1 bg-white float-left" src="{{asset('images/featuredimg/'.$product->featuredimage)}}" height="150px" width="150px" />
                    @endif
                    <input type="file" class="form-control" name="featuredimage" id="file"/>
                    <small>Select an image to change the product image</small>
                </div>
               </div>
               <div class="row p-3">
                <label for="">Product Gallery Images</label><br>
                <div class="form-group col-md-12 darkerlightbg">
                    @if (file_exists('images/featuredimg/'. $product->featuredimage) )
                        @foreach ($product->galleryimages as $image)
                        <div class="form-check form-check-inline m-1 p-1">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" value="{{$image->name}}" name="inimages[]" checked />
                              <img class=" bg-white float-left" src="{{asset('images/galleryimages/'.$image->name)}}" height="70px" width="70px" />                          
                            </label>
                          </div>
                        @endforeach
                        @endif
                    <input type="file" class="form-control" name="galleryimages[]" id="file" multiple/>
                </div>
            
               </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" id="submitProduct" type="submit">Save</button>
                </div>
            </form>
    </div>
   
</div>
<style>
    .form-check-inline .form-check-input{
        margin-left: -15px !important;
    }
    
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

    .img-wraps {
    position: relative;
    display: inline-block;
    
    font-size: 0;
}
.img-wraps .closes {
    position: absolute;
    top: 0px;
    right: 0px;
    z-index: 100;
    background-color: #FFF;
    padding: 4px 3px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
    border:1px solid red;
}
.img-wraps:hover .closes {
    opacity: 1;
}
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<script>
   $(function () {
    var input_file = document.getElementById('products_uploaded');
    var remove_products_ids = [];
    var product_dynamic_id = 0;
    $("#products_uploaded").change(function (event) {
        var len = input_file.files.length;
        $('#display_product_list ul').html("");
        
        for(var j=0; j<len; j++) {
            var src = "";
            var name = event.target.files[j].name;
            var mime_type = event.target.files[j].type.split("/");
            if(mime_type[0] == "image") {
              src = URL.createObjectURL(event.target.files[j]);
            } else if(mime_type[0] == "video") {
              src = 'icons/video.png';
            } else {
              src = 'icons/file.png';
            }
            $('#display_product_list ul').append("<li id='" + product_dynamic_id + "'><div class='ic-sing-file'><img id='" + product_dynamic_id + "' src='"+src+"' title='"+name+"'><p class='close' id='" + product_dynamic_id + "'>X</p></div></li>");
            product_dynamic_id++;
        }
    });
    $(document).on('click','p.close', function() {
        var id = $(this).attr('id');
        remove_products_ids.push(id);
        $('li#'+id).remove();
        if(("li").length == 0) document.getElementById('products_uploaded').value="";
    });
    $("form#multiple-files-upload").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("remove_products_ids", remove_products_ids);
        $.ajax({
              url: 'upload.php',
              type: 'POST',
              data: formData,
              processData: false, 
              contentType: false,
              
              success: function(data) {
                 $('#display_product_list ul').html("<li class='text-success'>Files uploaded successfully!</li>");
                 $('#products_uploaded').val("");
              },
              error: function(e) {
                  $('#display_product_list ul').html("<li class='text-danger'>Something wrong! Please try again.</li>");                    
              }    
        });
    });
});
</script>
@endsection