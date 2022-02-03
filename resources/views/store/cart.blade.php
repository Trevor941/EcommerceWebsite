@extends('store.layouts.app')
@section('content')
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Cart</li>
                </ul>
                @if(session('removeditem'))
                <div class="alert alert-danger">
                    <p>{{session('removeditem')}}</p>
                </div>
                @endif
                @if(session('addeditem'))
                <div class="alert alert-success">
                    <p>{{session('addeditem')}}</p>
                </div>
                @endif
            </div>
        </div>
        <!-- Breadcrumb End -->
     
        <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle">
                                        @if(session('cart'))
                                        @foreach(session('cart') as $id => $product)
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#"><img src="{{asset('images/featuredimg/'.$product['featuredimage'])}}" alt="Image"></a>
                                                    <p>{{$product['name']}}</p>
                                                </div>
                                            </td>
                                            <td>${{$product['regularprice']}}</td>
                                            <td>
                                                {{-- <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input type="text" value="{{$product['quantity']}}">
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div> --}}
                                                <form action="{{route('updatecart')}}" method="POST">
                                                    @csrf
                                                    <input type="submit" value="-" name="decreaseproductquantity">
                                                    <input type="hidden" value="{{$product['id']}}" name="id" >
                                                    <input type="text" name="quantity" value="{{$product['quantity']}}" readonly>
                                                    <input type="submit" value="+" name="increaseproductquantity">
                                                </form>
                                            </td>
                                            <td>${{$product['regularprice'] * $product['quantity']}}.00</td>
                                            <td>
                                                <form action="{{route('removefromcart')}}" method="POST">
                                                    <input type="hidden" value="{{$product['id']}}" name="id" >
                                                    @csrf
                                                 {{-- <button type="submit" class="btn btn-sm btn-danger">Remove</button> --}}
                                                    <button type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                       @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart-page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- <div class="coupon">
                                        <input type="text" placeholder="Coupon Code">
                                        <button>Apply Code</button>
                                    </div> --}}
                                </div>
                                <div class="col-md-12">
                                    <div class="cart-summary">
                                        <div class="cart-content">
                                            <h1>Cart Summary</h1>
                                            {{-- <p>Sub Total<span>$99</span></p> --}}
                                            {{-- <p>Shipping Cost<span>$1</span></p> --}}
                                            <hr>
                                            <p>Grand Total<span>${{Session::get('total')}}</span></p>
                                        </div>
                                        <div class="cart-btn">
                                            {{-- <button>Update Cart</button> --}}
                                            <button style="float: right;">Checkout</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->

@endsection