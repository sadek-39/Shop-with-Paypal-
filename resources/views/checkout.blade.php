@extends('layouts.app')
@section('content')
<h2>Checkout</h2>

<h3>Shipping address</h3>
<form action="{{route('orders.store')}}" method="POST">
@csrf
{{-- @include('_errors') --}}
<div class="form-group">
  <label for="">Full Name</label>
  <input type="text" class="form-control" name="shipping_fullname" id=""  placeholder="Your Name">
  
</div>
<div class="form-group">
    <label for="">state</label>
    <input type="text" class="form-control" name="shipping_state" id=""  placeholder="Your state">
    
  </div>
  <div class="form-group">
    <label for="">City</label>
    <input type="text" class="form-control" name="shipping_city" id=""  placeholder="Your City">
    
  </div>
  <div class="form-group">
    <label for="">Zip</label>
    <input type="text" class="form-control" name="shipping_zipcode" id=""  placeholder="Your Zipcode">
    
  </div>
  <div class="form-group">
    <label for="">Address</label>
    <input type="text" class="form-control" name="shipping_address" id=""  placeholder="Your Address">
    
  </div>
  <div class="form-group">
    <label for="">Modile</label>
    <input type="Number" class="form-control" name="shipping_phone" id=""  placeholder="Your Mobile number">
    
  </div>
  <h4>Payment option</h4>
  <div class="form-check">
      <label class="form-check-label">
      <input type="radio" class="form-check-input" name="payment-method" value="cash on delivery">
      Cash On delivery
    </label>
   
  </div>
  <div class="form-check">
    <label class="form-check-label">
    <input type="radio" class="form-check-input" name="payment-method" value="paypal">
    paypal
  </label>
 
</div>

  <button type="submit" class="btn btn-primary mt-3" >Place Order</button>








</form>

@endsection