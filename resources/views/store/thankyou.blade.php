@extends('store.layouts.app')
@section('content')
        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap">
            <div class="container-fluid">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <li class="breadcrumb-item active">Payment</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
     <hr>
        <!-- Cart Start -->
        <div class="cart-page">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
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
                                        <div class="cart-content text-center">
                                            <h1>Thank You</h1>
                                            <hr>
                                            <p class="text-success">Thank you for purchasing our product. <br> Your Order ID is <b>{{Session::get('order_id')}}</b></p>
                                            <hr>
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