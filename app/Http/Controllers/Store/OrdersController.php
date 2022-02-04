<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
class OrdersController extends Controller
{
    public function checkout(){
        return view('store.checkout');
    }

    public function createorder(Request $request){
        
         if($request->session()->has('cart')){
          $neworder = new Order();
          $neworder->cost = $request->session()->get('total');
          $neworder->firstname = $request->firstname;
          $neworder->lastname = $request->lastname;
          $neworder->email = $request->email;
          $neworder->status = 'unpaid';
          $neworder->city = $request->city;
          $neworder->address = $request->address;
          $neworder->country = $request->country;
          $neworder->phone = $request->phone;
          $neworder->date = date('Y-m-d');
          $neworder->save();

          $cart = $request->session()->get('cart');
          $order_id = 0;
          foreach($cart as $id => $product){
            $product = $cart[$id];
            $product_id = $product['id'];
            $product_name = $product['name'];
            $product_price = $product['regularprice'];
            $product_quantity = $product['quantity'];
            $product_image = $product['featuredimage'];
            
            $order_id = $neworder->id;
            $neworderitem = new OrderItem;
            $neworderitem->order_id = $neworder->id;
            $neworderitem->product_id = $product_id;
            $neworderitem->product_name = $product_name;
            $neworderitem->product_price = $product_price;
            $neworderitem->product_featuredimage = $product_image;
            $neworderitem->quantity = $product_quantity;
            $neworderitem->order_date = date('Y-m-d');
            $neworderitem->save();
          }
          $request->session()->put('order_id', $order_id);
          return redirect()->route('payment');
          
         }
    }
}
