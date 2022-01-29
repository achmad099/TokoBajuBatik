@extends('layouts.app')

@section('content')
    
    <div class="container">
                <p><span class="font-weight-bold">{{ count($products) }}</span> Products found</p>
        <hr>
        <div class="row mt-4">
            <div class="col-md-4 offset-md-8">
                <div class="form-group">
                    <select id="order_field" class="form-control">
                        <option value="" disabled selected>Urutkan</option>
                        <option value="best_seller">Best Seller</option>
                        <option value="termurah">Termurah</option>
                        <option value="termahal">Termahal</option>
                        <option value="terbaru">Terbaru</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="product-list">
            @foreach ($products as $idx => $product)
                @if ($idx == 0 || $idx % 4 == 0)
                    <div class="row mt-4">
                @endif
                <div class="col-md-3">
                    <div class="card border-0">
                        <img src="{{ route('products.image', ['imageName' => $product->image_url]) }}"
                            class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('products.show', ['id' => $product->id]) }}">
                                    {{ $product->name }}
                                </a>
                            </h5>
                            {{ (int)$product->rating }}
                            @if($product->rating == 0 || $product->rating < 1)
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                                <span class="fa fa-star "></span>
                            @elseif($product->rating == 1 || $product->rating < 2)
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            @elseif($product->rating == 2 || $product->rating < 3) 
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            @elseif($product->rating == 3 || $product->rating < 4) 
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            @elseif($product->rating == 4 || $product->rating < 5) 
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                            @else
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                            @endif
                            <p class="card-text">
                                Rp. {{ $product->price }}
                            </p>
                            <a href="{{ route('carts.add', ['id' => $product->id]) }}" class="btn btn-primary">Beli</a>
                        </div>
                    </div>
                </div>
                @if ($idx > 0 && $idx % 4 == 3)
        </div>
        @endif
        @endforeach
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#order_field').change(function() {
                $.ajax({
                    type: 'GET',
                    url: '/products',
                    data: {
                        order_by: $(this).val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        var products = '';
                        $.each(data, function(idx, product) {
                            if (idx == 0 || idx % 4 == 0) {
                                products += '<div class="row mt-4">';
                            }

                            products +=
                                '<div class="col-md-3">' +
                                '<div class="card border-0">' +
                                '<img src="/products/image/' + product.image_url +
                                '"class="card-img-top" alt="...">' +
                                '<div class="card-body">' +
                                '<h5 class="card-title">' +
                                '<a href="/products/' + product.id + '">' + product
                                .name + '</a>' +
                                '</h5>' +
                                '<p class="card-text">' +
                                product.price +
                                '</p>' +
                                '<a href="/carts/add/' + product.id +
                                '"class="btn btn-primary">Beli</a>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        });
                        $('#product-list').html(products);
                    },
                    error: function(data) {
                        alert('Unable to handle request');
                    }
                })
            });
        });
    </script>
@endsection
