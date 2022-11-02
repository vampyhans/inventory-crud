@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products List') }}</div>

                <div class="card-body">
                    @if ($products->count() > 0)
                    @foreach ($products as $product)
                    <table class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                <a href="{{URL::route('edit-product', ['id' => Crypt::encrypt($product->id)])}}" class="btn-sm btn btn-success" type="button">Edit Product</a>
                            </td>
                            <td>
                                <a href="{{URL::route('delete-product', ['id' => Crypt::encrypt($product->id)])}}" class="btn btn-sm btn-danger" type="button">Delete Product</a>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                    @endforeach
                    @else
                    <h3 class="text-danger">No Products Available !!!</h3>
                    @endif
                    <a href={{URL::route('add-product')}} class="btn btn-primary mt-5" type="button">Create Product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
