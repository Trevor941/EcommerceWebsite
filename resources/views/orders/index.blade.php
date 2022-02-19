@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12 header">
        <h3 class="preview-h">Orders</h1>
    </div>
</div>
<div class="row pl-3 pr-3 pb-3">
    <div class="col-md-7">
        <span><b><a href="/orders">All</a> </b>({{$orders->count()}}) |</span>
        <span>
            <form class="form-inline" action="{{route('orders.index')}}" method="GET" id="on-hold" style="display: inline-block;">
                <input type="text" name="on-hold" value="on-hold" hidden>
                <a href="javascript:{}" onclick="document.getElementById('on-hold').submit();">On hold </a>({{$onhold->count()}}) |
        </form>
        </span>
        <span>
        <form class="form-inline" action="{{route('orders.index')}}" method="GET" id="searchprocessing" style="display: inline-block;">
                <input type="text" name="processing" value="processing" hidden>
                <a href="javascript:{}" onclick="document.getElementById('searchprocessing').submit();">Processing </a>({{$processing->count()}}) |
        </form>
        </span>
            <span>
                <form class="form-inline" action="{{route('orders.index')}}" method="GET" id="searchcompleted" style="display: inline-block;">
                        <input type="text" name="completed" value="completed" hidden>
                        <a href="javascript:{}" onclick="document.getElementById('searchcompleted').submit();">Completed </a>({{$completed->count()}}) |
                </form>
                </span>
                <span>
                    <form class="form-inline" action="{{route('orders.index')}}" method="GET" id="searchcancelled" style="display: inline-block;">
                            <input type="text" name="cancelled" value="cancelled" hidden>
                            <a href="javascript:{}" onclick="document.getElementById('searchcancelled').submit();">Cancelled </a>({{$cancelled->count()}}) |
                    </form>
                    </span>
                    <span>
                        <form class="form-inline" action="{{route('orders.index')}}" method="GET" id="searchrefunded" style="display: inline-block;">
                                <input type="text" name="refunded" value="refunded" hidden>
                                <a href="javascript:{}" onclick="document.getElementById('searchrefunded').submit();">Refunded </a>({{$refunded->count()}})
                        </form>
                        </span>
    </div>
    <div  class="col-md-5">
        <form action="{{route('orders.index')}}" method="GET" class="form-inline" >
            <div class="form-group mr-1">
                <input type="text" name="searchorders" class="form-control" value="{{request()->query('searchorders')}}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-indexbtns">Search orders</button>
            </div>
        </form>
    </div>
</div>
<div class="row pl-3 pr-3 pb-3">
    <div class="col-md-6">
        <form action="" class="form-inline">
            <div class="form-group mr-1">
                <select name="bulkactionslist" id="bulkactionslist" class="form-control">
                    <option>Bulk actions</option>
                    <option value="bin">Move to Bin</option>
                   @if($orderstatuses->count() > 0)
                   @foreach ($orderstatuses as $orderstatus)
                   <option value="{{$orderstatus->id}}">Change status to {{$orderstatus->name}}</option>
                   @endforeach
                   @endif
                </select>
            </div>
            <div class="form-group">
                <a href="javascript:{}" class="btn btn-indexbtns" onclick="document.getElementById('bulkactionsorders').submit();">Apply</a>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <form action="{{route('orders.index')}}" method="GET" class="form-inline">
            <div class="form-group mr-1">
                <select name="selectedcategory" id="" class="form-control">
                    <option value="">All Dates</option>
                    <option value="">04 Feb</option>
                </select>
            </div>
            <div class="form-group mr-1">
                    <input type="text" id="search" name="firstname" placeholder="Search" class="form-control" />
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
            <form action="{{route('orders.bulkactionsorders')}}" method="POST" id="bulkactionsorders">
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
                       <th>Order</th>
                       <th>Preview</th>
                       <th>Date</th>
                         <th>Status</th>
                         <th>Total</th>
                   </tr> 
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                         <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$order->id}}" name="order_ids[]">
                                    <label class="form-check-label" for="defaultCheck1">

                                    </label>
                                  </div>
                            </td>
                            <td>
                              <a href="#">#{{$order->id}} {{$order->firstname}} {{$order->lastname}}</a>  
                            </td>
                            <td>
                                <a href="#"><i class="fas fa-eye"></i></a>
                            </td>
                            <td>
                                <a href="#">{{$order->created_at->format("d M Y")}} at {{$order->created_at->format("h:i")}}</a>
                            </td>
                            <td>
                                @if ($order->orderstatuses_id === 1)
                               <span class="badge badge-info p-2"> {{$order->orderstatuses->name}}</span>
                               @elseif ($order->orderstatuses_id === 2)
                               <span class="badge badge-secondary p-2"> {{$order->orderstatuses->name}}</span>
                               @elseif ($order->orderstatuses_id === 3)
                               <span class="badge badge-success p-2"> {{$order->orderstatuses->name}}</span>
                               @elseif ($order->orderstatuses_id === 4)
                               <span class="badge badge-danger p-2"> {{$order->orderstatuses->name}}</span>
                               @else
                               <span class="badge badge-warning p-2"> {{$order->orderstatuses->name}}</span>
                                @endif
                               
                            </td>
                            <td>{{$order->cost}}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </form>
            {{ $orders->appends(['search' => request()->query('search')])->links() }}
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
       
 
           var route = "{{ url('autocomplete-search') }}";
        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                    console.log(process(data));
                });
            }
        });
        })
        </script>
@endsection