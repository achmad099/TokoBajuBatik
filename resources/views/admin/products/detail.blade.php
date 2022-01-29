@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="/admin/products" class="btn btn-primary"><i class="bi bi-caret-left-fill"></i>Kembali</a>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-4">
                <img src="{{ url('/image/view/' . $detail['image_url']) }}" class="img w-100">
            </div>
            <div class="col-md-6">
                <h3>{{ $detail['name'] }}</h3>
                <h4>Rp {{ $detail['price'] }}</h4>
                <hr>
                <p class="font-weight-bold">Deskripsi</p>
                <p>{{ $detail['description'] }}</p>
            </div>
        </div>
    </div>
@endsection
