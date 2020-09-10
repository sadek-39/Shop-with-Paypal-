<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function add(Product $product)
    {
        # code...
        // dd($product);
        // $product=Product::find($productId)
        // add the product to cart
        \Cart::session(auth()->id())->add(array(
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => 4,
        'attributes' => array(),
        'associatedModel' => $product
));
        return \redirect()->route('cart.show');
    }
    public function index()
    {
        # code.
        $cartitems = \Cart::session(auth()->id())->getContent();
            
        return view('cartshow',\compact('cartitems'));
    }
    public function delete($itemId)
    {
        # code...
        \Cart::session(auth()->id())->remove($itemId);
        return back();
    }
    public function update($itemId)
    {
        # code...
        \Cart::session(auth()->id())->update($itemId,[
            'quantity' =>array(
                'relative' => false,
                'value' => request('quantity')
            ),
        ]);
        return back();
    }
    public function check()
    {
        return view('checkout');
        # code...
    }

}
