@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update product') }}</div>

                <div class="card-body">
                    <form action="{{ route('update-product', ['id' => Crypt::encrypt($product->id)]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value={{ $product->name }}>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-row d-flex">
                          <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            <input type=number step=0.01 class="form-control @error('price') is-invalid @enderror" id="price" name="price" value={{ $product->price }}>
                            @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value={{ $product->quantity }}>
                            @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                          </div>
                        </div>
                        <button type="submit" class="mt-5 btn btn-primary">Update Product</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
