<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_fullname'=>'required',
            'shipping_state'=>'required',
            'shipping_city'=>'required',
            'shipping_zipcode'=>'required',
            'shipping_address'=>'required',
            'shipping_phone'=>'required',
            'payment-method'=>'required',

        ]);
        $order=new Order();
        $order->order_number =\uniqid('OrderNumber');
        $order->grand_total= \Cart::session(auth()->id())->getSubTotal();
        $order->item_count=\Cart::session(auth()->id())->getcontent()->count();
       
        $order->shipping_fullname = $request->shipping_fullname;
        $order->shipping_state = $request->shipping_state;
        $order->shipping_city = $request->shipping_city;
        $order->shipping_zipcode = $request->shipping_zipcode;
        $order->shipping_address = $request->shipping_address;
        $order->shipping_phone = $request->shipping_phone;

        if(!$request->has('billng_fullname')){
        $order->billing_fullname = $request->shipping_fullname;
        $order->billing_state = $request->shipping_state;
        $order->billing_city = $request->shipping_city;
        $order->billing_zipcode = $request->shipping_zipcode;
        $order->billing_address = $request->shipping_address;
        $order->billing_phone = $request->shipping_phone;


        }else{
        $order->billing_fullname = $request->billing_fullname;
        $order->billing_state = $request->billing_state;
        $order->billing_city = $request->billing_city;
        $order->billing_zipcode = $request->billing_zipcode;
        $order->billing_address = $request->billing_address;
        $order->billing_phone = $request->billing_phone;



        }
        

        $order->user_id = auth()->id();
        if(request('payment-method')=='paypal'){
            $order->payment_method='paypal';
        };


        $order->save();
        //save order items
        $cartitems=\Cart::session(auth()->id())->getcontent();
        foreach ($cartitems as $item) {
            # code...
            $order->items()->attach($item->id,['price'=>$item->price,'quantity'=>$item->quantity]);
        };
        //payment
        if(request('payment-method')=='paypal'){
            //redirect paypal
            return \redirect()->route('paypal.checkout',$order->id);

        }

        //empty cart
        \Cart::session(auth()->id())->clear();


        return "order completed.Thank you";
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
