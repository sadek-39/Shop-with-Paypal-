<?php

namespace App\Http\Controllers;

use App\Order;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    public function getExpressCheckout($orderId)
    {
        $checkoutData = $this->checkoutData($orderId);
        

        //dd($cartItems);
       
    $provider=new ExpressCheckout();

    $response=$provider->setExpressCheckout($checkoutData);

    
    return \redirect($response['paypal_link']);  
    
       
    }
    private function checkoutData($orderId)
    {
        $cart=\Cart::session(auth()->id());
        $cartItems=array_map(function($item){
            return[
                'name'=>$item['name'],
                'price'=>$item['price'],
                'qty'=>$item['quantity'],
            ];
        },$cart->getContent()->toarray());


        $checkoutData=[
            'items' => $cartItems,
            'return_url' => route('paypal.checkoutsuccess',$orderId),
            'cancel_url' => route('paypal.checkoutcancel'),
            'invoice_id' =>\uniqid(),
            'invoice_description'=> "order description",
            'total' =>$cart->getTotal(),
        ];
       
        return $checkoutData;

    }
    
    public function cancelpayment()
    {
        # code...
        dd('failed');
    }
    public function getExpressCheckoutSuccess(Request $request,$orderId)
    {
        # code...
        $token=$request->get('token');
        $payerId=$request->get('payerID');
        $provider= new ExpressCheckout();
        $checkoutData = $this->checkoutData($orderId);
        $response=$provider->getExpressCheckoutDetails($token);
        if(\in_array(\strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING'])){
            //PERFORM transaction on paypal
            $payment_status=$provider->doExpressCheckoutPayment($checkoutData,$token,$payerId);
            // $payment_status['PAYMENTINFO_0_PAYMENTSTATUS']='Completed';
            $status=$payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            
            // if(\in_array($status,['Completed','Processed'])){
            //     $order=Order::find($orderId);
            //     $order->is_paid=1;
            //     $order->save();
            //     //send mail


            //     return redirect('/')->withMessage('Payment Successful');

            //}
            
            
        }
        dd('payment successful');
        // return redirect('/')->withError("payment unsuccessful.something is wrong");
    }

}
