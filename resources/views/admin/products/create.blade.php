@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content center">
            <div class="col">
                <h2>Tambah Produk Baju</h2>
                <br>

                @if (count($errors))
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <br>

                <form enctype="multipart/form-data" action="{{ route('admin.products.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="name" class="form-control" placeholder="Nama Produk">
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="price" class="form-control" placeholder="Harga">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" id="ckview"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image_url" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/admin/products" class="btn btn-danger">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        tinymce.init({
            selector: '#ckview',
            forced_root_block: ""
        });
    </script>
@endsection
