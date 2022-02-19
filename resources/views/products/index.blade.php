@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 header">
        <h3 class="preview-h">Products</h1>
            <ul>
            {{-- @foreach ($role->users() as $user )
                <li>{{$user->name}}</li>
            @endforeach --}}
        </ul> 
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
        <span><a href="/AllTrashedProducts">Trash </a> ({{$AllTrashedProducts->count()}}) </span>
        
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
                <select name="bulkactionslist" id="bulkactionslist" class="form-control">
                    <option value="1">Bulk actions</option>
                    <option value="2">Trash</option>
                </select>
            </div>
            <div class="form-group">
                <a href="javascript:{}" class="btn btn-indexbtns" onclick="document.getElementById('bulkactions').submit();">Apply</a>
            </div>
        </form>
    </div>
    <div>
        <form action="{{route('products.index')}}" method="GET" class="form-inline">
            <div class="form-group mr-1">
                <select name="selectedcategory" id="" class="form-control">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                      @if(request()->query('selectedcategory') === "$category->id" )  
                         selected
                         @endif
                         >{{$category->name}} ({{$category->products->count()}})
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mr-1">
                <select name="selectedstock" id="" class="form-control">
                    <option value="">Filter by stock status </option>
                    <option value="1" @if(request()->query('selectedstock' ) === "1") selected @endif>Instock</option>
                    <option value="2" @if(request()->query('selectedstock' ) === "2") selected @endif>Low Stock</option>
                    <option value="3" @if(request()->query('selectedstock' ) === "3") selected @endif>Out of Stock</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-indexbtns">Filter</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="">
      <ul style="list-style:none">
          @foreach ($errors->all() as $error)
          <li class="alert alert-warning">{{ $error }}</li>
          @endforeach
        </ul>
    </div>
  </div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <form action="{{route('products.bulkactions')}}" method="POST" id="bulkactions">
                @csrf
                <input type="text" name="selectedaction" id="selectedaction"  hidden>
            <table class="table table-bordered table-striped">
                <thead class="bg-white">
                   <tr>
                       <th>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"  id="select-all">
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
                                    <input class="form-check-input" type="checkbox" value="{{$product->id}}" name="product_ids[]">
                                    <label class="form-check-label" for="defaultCheck1">

                                    </label>
                                  </div>
                            </td>
                            <td>
                                @if (file_exists('images/featuredimg/'. $product->featuredimage) )
                               <img class="bg-white p-1"  src="{{asset('images/featuredimg/'.$product->featuredimage)}}" alt="{{$product->featuredimage}}" height="50px" width="50px">
                                @else
                                <img class="bg-white p-1" src="{{asset('images/default/blankimage.jpg')}}" alt="{{$product->featuredimage}}" height="50px" width="50px">
                                @endif
                            </td>
                            <td><b>{{$product->name}}</b><br>
                            <span> ID:{{$product->id}} | <a href="{{route('products.edit', $product->id)}}">Edit</a> |
                                 <a class="text-danger" href="/trashProduct/{{$product->id}}">Trash</a>
                                | <a class="" href="">View</a> | <a href="">Duplicate</a>
                            </span>
                            </td>
                            <td>{{$product->SKU}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->regularprice}}</td>
                            <td>
                                @if (Count($product->categories) > 0)
                                @foreach ($product->categories as $category)
                                <a href="{{route('categories.edit', $category->id)}}">{{$category->name }},</a>
                                 @endforeach
                                @endif
                            </td>
                            <td>
                                @if (Count($product->tags) > 0)
                                @foreach ($product->tags as $tag)
                                <a href="{{route('tags.edit', $tag->id)}}">{{$tag->name }},</a>
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
        </form>
            {{ $products->appends(['search' => request()->query('search')])->links() }}
        </div>
    </div>
</div>
<style>
    .btn-indexbtns{
        border-color: #858796;  
    }
    </style>
    <script>
        $(document).ready(function(){
            $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
            });

           $('#bulkactionslist').change( function (){
            var selectedbulkaction = $('#bulkactionslist').find(":selected");
            var selectedbulkactionval = $(selectedbulkaction).val();
            console.log(selectedbulkactionval);
            $("#selectedaction").val(selectedbulkactionval);
           })
        })
 

        </script>
@endsection