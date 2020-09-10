@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h2>Products</h2>
        <div class="row">
            @foreach ($product as $item)
        <div class="col-md-4">
            <div class="card">
            <img class="card-img-top" src="{{asset('images/2.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title">{{$item->name}}</h4>
                <p class="card-text">{{$item->description}}</p>
                <p class="card-text">BDT {{$item->price}}</p>
                </div>
                <div class="card-body">
                <a href="{{route('cart.add',$item->id)}}" class="card-link">Add to cart</a>
                </div>
            </div>
        </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
