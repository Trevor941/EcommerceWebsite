@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 header">
        <h3 class="preview-h">All Categories</h1>
    </div>
</div>
<div class="row">
<div class="offset-md-4 col-md-8">
    <div class="row pl-3 pr-3 pb-2 justify-content-between">
        <div>
            .
        </div>
        <div>
            <form action="{{route('products.index')}}" method="GET" class="form-inline" >
                <div class="form-group mr-1">
                    <input type="text" name="searchresult" class="form-control" value="{{request()->query('searchresult')}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-indexbtns">Search Categories</button>
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
                    {{ $categories->appends(['search' => request()->query('search')])->links() }}
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<div class="row pt-3 pb-3 bg-white" style="
border-top: 1px solid #ddd !important;
">
    <div class="col-md-4">
      @isset($category)
      <h5>Edit new category</h5>
      @endisset
      @empty($category)
      <h5>Add new category</h5>
      @endempty
      
      <form action=" @isset($category) {{route('categories.update',$category->id)}} @endisset @empty($category){{route('categories.store')}} @endempty" method="POST" enctype="multipart/form-data">
        @isset($category)
            @method('PUT')
        @endisset
        @csrf
          <div class="form-group">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value=" @isset($category) {{$category->name}}  @endisset">
          </div>
          <div class="form-group">
            <label for="">Slug</label>
            <input type="text" class="form-control" name="slug" value="@isset($category) {{$category->slug}} @endisset">
        </div>
     
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="" class="form-control"> @isset($category) {{$category->description}} @endisset</textarea>
        </div>
        <div class="form-group">
            <label for="">Thumbnail</label>
            <input type="file" name="image" class="">
        </div>
        <div>
            <button type="submit" value="submit" class="btn btn-primary">
                @isset($category) Save Changes @endisset
                @empty($category) Add New Category @endempty
            </button>
        </div>
      </form>
    </div>
    <div class="col-md-8">
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
                                 <th>Description</th>
                                 <th>Slug</th>
                                 <th>Count</th>
                           </tr> 
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                              
                                            </label>
                                          </div>
                                    </td>
                                    <td>
                                        @if ($category->image === '')
                                        <img class="bg-white p-1" src="{{asset('images/default/blankimage.png')}}" alt="{{$category->image}}" height="50px" width="50px">
                                        @else
                                        <img class="bg-white p-1"  src="{{asset('images/'.$category->image)}}" alt="{{$category->image}}" height="50px" width="50px">
                                        @endif
                                    </td>
                                    <td><b>{{$category->name}}</b><br>
                                    <span><a href="{{route('categories.edit', $category->id)}}">Edit</a> |
                                         <a class="" href="">View</a> | <a href="">Duplicate</a> |
                                         <a  href="#" onclick="document.getElementById('deletecat').submit();">(Delete <i class="fas fa-frown"></i>)</a>
                                         <form method="POST" id="deletecat" action = "{{route('categories.destroy', $category->id)}}">
                                            @csrf
                                            @method('delete')
                                            {{-- <button class="text-danger" type="submit" >Delete</button> --}}
                                         </form>
                                        
                                    </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($category->description == '')
                                          &mdash;
                                        @else
                                        {{$category->description}}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($category->slug == '')
                                        &mdash; 
                                    @else
                                    {{$category->slug}}
                                    @endif
                                    </td>
                                    <td class="text-center">{{$category->products->Count()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
        
                    </table>
                    {{ $categories->appends(['search' => request()->query('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .btn-indexbtns{
        border-color: #858796;  
    }
    </style>
@endsection