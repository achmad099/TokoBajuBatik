@extends('layouts.app')

@section('content')
<div class="container col-md-8">
    <h1 align="center">Product</h1>
    <div class="row">
        <div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Tambah Produk</a>
        </div>
        <br><br>
        <div class="table-responsive">
            <table class="table table-borderless table-sm">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Created at</th>
                        <th colspan="3"><center>Action</center></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td><img src="{{ route('admin.products.image', ['imageName' => $product['image_url']]) }}" width="100" /></td>
                            <td class="align-middle">{{ $product['name'] }}</td>
                            <td class="align-middle">Rp. {{ $product['price'] }}</td>
                            <td class="align-middle">{{ $product['created_at'] }}</td>
                            <td class="align-middle">
                                <a href="{{ route('admin.products.show', ['id'=>$product['id']]) }}" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('admin.products.edit', ['id'=>$product['id']]) }}" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('admin.products.destroy', ['id'=>$product['id']])}}" method="POST">
                                    {{method_field('DELETE')}}
                                    @csrf
                                    <button type="submit" class="btn btn-danger" value="Delete"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
