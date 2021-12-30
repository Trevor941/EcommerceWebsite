@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 header">
        <h3 class="preview-h">Trash</h1>
    </div>
</div>
<div class="row pl-3 pr-3 pb-2 justify-content-between">
    <div >
        <span><b><a href="/products">All</a> </b>({{$withTrashed->count()}}) |</span>
        <span>
            <form class="form-inline" action="{{route('products.index')}}" method="GET" id="searchpublished" style="display: inline-block;">
                <input type="text" name="published" value="published" hidden>
                <a href="javascript:{}" onclick="document.getElementById('searchpublished').submit();">Published </a>({{$published->count()}}) |
        </form>
        </span>
        <span>
        <form class="form-inline" action="{{route('products.index')}}" method="GET" id="searchdraft" style="display: inline-block;">
                <input type="text" name="draft" value="draft" hidden>
                <a href="javascript:{}" onclick="document.getElementById('searchdraft').submit();">Draft </a>({{$draft->count()}}) |
        </form>
        </span>
            <span><a href="/AllTrashedProducts">Trash </a> ({{$AllTrashedProducts->count()}}) |</span>
        <span><a href="#">Sorting </a></span>
    </div>
    <div>
        <form action="{{route('products.index')}}" method="GET" class="form-inline" >
            <div class="form-group mr-1">
                <input type="text" name="searchresult" class="form-control" value="{{request()->query('searchresult')}}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-indexbtns">Search products</button>
            </div>
        </form>
    </div>
</div>
<div class="row pl-3 pr-3 pb-3 justify-content-between">
    <div>
        <form action="" class="form-inline">
            <div class="form-group mr-1">
                <select name="" id="" class="form-control">
                    <option value="">Bulk actions</option>
                    <option value="">Trash</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-indexbtns">Apply</button>
            </div>
        </form>
    </div>
    <div>
        <form action="" class="form-inline">
            <div class="form-group mr-1">
                <select name="" id="" class="form-control">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}} ({{$category->products->count()}})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-1">
                <select name="" id="" class="form-control">
                    <option value="">Filter by stock status </option>
                    <option value="1">Instock</option>
                    <option value="0">Out of Stock</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-indexbtns">Filter</button>
            </div>
        </form>
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
                    @foreach ($AllTrashedProducts as $product)
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
                            <span> ID:{{$product->id}} | <a href="/restoreProduct/{{$product->id}}">Restore</a> |
                                 <a class="text-danger" href="/deleteProduct/{{$product->id}}">Delete Permanently</a>
                                | <a href="">Duplicate</a>
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
                            <td>@if ($product->published ===1)
                                Published
                                @else
                                Draft
                            @endif<br> {{date('d/m/Y', strtotime($product->created_at))}} at {{$product->created_at->format('H:i')}} </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            {{-- {{ $products->links() }} --}}
        </div>
    </div>
</div>
<style>
    .btn-indexbtns{
        border-color: #858796;  
    }
    </style>
@endsection