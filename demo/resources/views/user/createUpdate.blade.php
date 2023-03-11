@extends('layouts.app')

@if (session('success'))
      <div class="alert alert-success">
         {!! session('success') !!}
      </div>
@endif
@if (session('error'))
      <div class="alert alert-warning">
         {!! session('error') !!}
      </div>
@endif
@error('name')
   <span class="text-danger">{{$message}}</span>
@enderror

@section('content')
<div class="container">

    @isset($customer)
        <form class="flex flex-col w-full" method="POST" action="{{ URL('/user/customers/'.$customer->id) }}">
            @method('put')
    @else
        <form class="flex flex-col w-full" method="POST" action="{{ URL('/user/customers') }}" enctype="multipart/form-data">
    @endif
            @csrf
            <div class="form-group row">
                <label for="billing_address" class="col-sm-2 col-form-label">Billing Address</label>
                <div class="col-sm-10">
                <input type="text" name= "billing_address" class="form-control"placeholder="Billing Address" value="{{ @$customer->billing_address }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="shipping_address" class="col-sm-2 col-form-label">Shipping Address</label>
                <div class="col-sm-10">
                <input type="text" name= "shipping_address" class="form-control"placeholder="Shipping Address" value="{{ @$customer->shipping_address }}" required>
                </div>
            </div> 
            <button class="positive-button" type="submit">Save </button>
        <form>
</div>
@endsection
