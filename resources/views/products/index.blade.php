@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 header">
        <h3 class="preview-h">All Products</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-white">
                   <tr>
                       <th>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          
                        </label>
                      </div>
                    </th>
                       <th>Image</th>
                       <th>Name</th>
                       <th>SKU</th>
                         <th>Stock</th>
                         <th>Price</th>
                         <th>Categories</th>
                         <th>Tags</th>
                         <th>Date</th>
                   </tr> 
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                      
                                    </label>
                                  </div>
                            </td>
                            <td>
                                @if ($product->featuredimage === '')
                                <img class="bg-white p-1" src="{{asset('images/blankimage.jpg')}}" alt="{{$product->featuredimage}}" height="50px" width="50px">
                                @else
                                <img class="bg-white p-1"  src="{{asset('images/'.$product->featuredimage)}}" alt="{{$product->featuredimage}}" height="50px" width="50px">
                                @endif
                            </td>
                            <td><b>{{$product->name}}</b><br>
                            <span> ID:{{$product->id}} | <a href="{{route('products.edit', $product->id)}}">Edit</a> | <a class="text-danger" href="">Trash</a> | <a href="">Duplicate</a>
                            </span>
                            </td>
                            <td>{{$product->SKU}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->regularprice}}</td>
                            <td>
                                @if (Count($product->categories) > 0)
                                @foreach ($product->categories as $category)
                                <a href="#">{{$category->name }},</a>
                                 @endforeach
                                @endif
                            </td>
                            <td>
                                @if (Count($product->tags) > 0)
                                @foreach ($product->tags as $tag)
                                <a href="#">{{$tag->name }},</a>
                                 @endforeach
                                @endif
                            </td>
                            <td>{{$product->ProductStatus->name}}<br> {{date('d/m/Y', strtotime($product->created_at))}} at {{$product->created_at->format('H:i')}} </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection