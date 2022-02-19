@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 header">
        <h3 class="preview-h">Tags</h1>
    </div>
</div>
<div class="row">
    <div class="offset-md-4 col-md-8">
        <div class="row pl-3 pr-3 pb-2 justify-content-between">
            <div>
                
            </div>
            <div>
                <form action="{{route('products.index')}}" method="GET" class="form-inline" >
                    <div class="form-group mr-1">
                        <input type="text" name="searchresult" class="form-control" value="{{request()->query('searchresult')}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-indexbtns">Search tags</button>
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
                        {{ $tags->appends(['search' => request()->query('search')])->links() }}
                    </div>
                </form>
            </div>
        </div>
    
    </div>
    </div>
<div class="row row pt-3 pb-3 bg-white" style="
border-top: 1px solid #ddd !important;
">
    <div class="col-md-4">
      @isset($tag)
      <h5>Edit new tag</h5>
      @endisset
      @empty($tag)
      <h5>Add new tag</h5>
      @endempty
      <hr>
      <form action=" @isset($tag) {{route('tags.update',$tag->id)}} @endisset @empty($tag){{route('tags.store')}} @endempty" method="POST" enctype="multipart/form-data">
        @isset($tag)
            @method('PUT')
        @endisset
        @csrf
          <div class="form-group">
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value=" @isset($tag) {{$tag->name}}  @endisset">
          </div>
          <div class="form-group">
            <label for="">Slug</label>
            <input type="text" class="form-control" name="slug" value="@isset($tag) {{$tag->slug}} @endisset">
        </div>
       
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="" class="form-control"> @isset($tag) {{$tag->description}} @endisset</textarea>
        </div>
    
        <div>
            <button type="submit" value="submit" class="btn btn-primary">
                @isset($tag) Save Changes @endisset
                @empty($tag) Add New tag @endempty
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
                               <th>Name</th>
                                 <th>Description</th>
                                 <th>Slug</th>
                                 <th>Count</th>
                           </tr> 
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                              
                                            </label>
                                          </div>
                                    </td>
                                    <td><b>{{$tag->name}}</b><br>
                                    <span><a href="{{route('tags.edit', $tag->id)}}">Edit</a> |
                                         <a class="" href="">View</a> | <a href="">Duplicate</a> |
                                         <a href="#" onclick="document.getElementById('deletetag').submit();">(Delete <i class="fas fa-frown"></i>)</a>
                                         <form method="POST" id="deletetag" action = "{{route('tags.destroy', $tag->id)}}">
                                            @csrf
                                            @method('delete')
                                            {{-- <button class="text-danger" type="submit" >Delete</button> --}}
                                         </form>
                                        
                                    </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($tag->description == '')
                                        &mdash;
                                       @else
                                        {{$tag->description}}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($tag->slug == '')
                                        {{$tag->slug}}
                                        @else
                                        {{$tag->slug}}
                                        @endif
                                       
                                    </td>
                                    <td class="text-center">{{$tag->products->Count()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
        
                    </table>
                    {{ $tags->appends(['search' => request()->query('search')])->links() }}
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