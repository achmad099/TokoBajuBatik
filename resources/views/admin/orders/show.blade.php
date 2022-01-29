@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>
                            <span class="badge badge-primary">Alamat Pengiriman</span>
                        </h2>
                        <p>
                            {{ $order->address }}, {{ $order->address_line2 }}, {{ $order->district }}, {{ $order->city }}, {{ $order->province }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h2>
                            <span class="badge badge-primary">Kode Pos</span>
                        </h2>
                        <p>
                            {{ $order->zip_code }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h2>
                            <span class="badge badge-primary">Harga Total</span>
                        </h2>
                        <p>
                            {{ $order->total_price }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:50%" colspan="2">Product</th>
                            <th style="width:10%">Price</th>
                            <th style="width:8%">Quantity</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td data-th="Product" >
                                    <img src="{{ route('products.image', ['imageName' => $orderItem->product->image_url]) }}" width="100"  class="img-responsive">
                                </td>
                                <td data-th="Product" class="align-middle">
                                    <a href="{{ route('products.show', ['id' => $orderItem->product->id]) }}">
                                        <h4 class="nomargin">{{ $orderItem->product->name }}</h4>
                                    </a>
                                </td>
                                <td data-th="Price" class="align-middle">
                                    {{ $orderItem->price }}
                                </td>
                                <td data-th="Quantity" class="align-middle">
                                    {{ $orderItem->quantity }}
                                </td>
                                <td data-th="Subtotal" class="text-center align-middle">
                                    {{ $orderItem->price * $orderItem->quantity }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
