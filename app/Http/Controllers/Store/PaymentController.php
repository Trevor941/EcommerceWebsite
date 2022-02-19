<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\Order;
use Illuminate\Support\Facades\DB;
class PaymentController extends Controller
{
    public function payment(){
        return view('store.payment');
    }

    function verifypayment(Request $request, $transaction_id){
        $request->session()->put('transaction_id', $transaction_id);
        return redirect('/completepayment');

    }

   
    function completepayment(Request $request){
        if($request->session()->has('order_id') && $request->session()->has('transaction_id')){
        $order_id = $request->session()->get('order_id');
        $transaction_id = $request->session()->get('transaction_id');
        $orderstatuses_id = 1;
        $payment_date = date('Y-m-d h:i:s');

        //change order status to paid 
        $affected = DB::table('orders')
        ->where('id', $order_id)
        ->update(['orderstatuses_id'=>$orderstatuses_id]);

        //store payment info in payments table
        DB::table('payments')->insert([
            'order_id'=>$order_id,
            'transaction_id' => $transaction_id,
            'date' => $payment_date
        ]);

        //remove everything from the session
        $request->session()->flush();
        return redirect('/thankyou')->with('order_id',  $order_id);



    }
    else{
        return redirect('/');
    }
}

public function thankyou(){
    return view('store.thankyou');
}
}
