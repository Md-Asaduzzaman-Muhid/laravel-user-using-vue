@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Customers') }}</div>
                <div class="card-body table-responsive">
                    @if(empty($customers)):
                        <p>No Customer Found ... </p>
                    @else
                        <table class="table ">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Billing Address</th>
                                <th scope="col">Shipping Address</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <th scope="row">{{ $customer->id }}</th>
                                    <td>{{ $customer->billing_address }}</td>
                                    <td>{{ $customer->shipping_address }}</td>
                                    <td>
                                        @if($customer->status== 0)
                                        <span class="text-danger">Not Active</span>
                                        @else
                                        <span class="text-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <form action="{{ URL('/user/customers/'.$customer->id) }}" method="post">
                                            <a class="btn btn-primary" href="{{ URL('/user/customers/'.$customer->id.'/edit') }}">Edit</a>
                                            @method('delete')
                                            @csrf
                                            <button type="submit" name="delete" class="btn btn-large btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
