@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justfiy-content-center">
            <div class="col">
                <h2>Menambahkan Alamat</h2>
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
                <form action="{{ route('admin.orders.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat Tujuan</label>
                                <textarea name="address" class="form-control" rows="3" placeholder="Nama Jalan"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="address_line2" type="text" class="form-control"
                                            placeholder="Desa/Kelurahan">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="district" type="text" class="form-control" placeholder="Kecamatan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="city" type="text" class="form-control" placeholder="Kota/Kabupaten">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="province" type="text" class="form-control" placeholder="Provinsi">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="phone_number" type="number" class="form-control" placeholder="Nomor Telepon">
                            </div>
                            <div class="form-group">
                                <label>Kode Pos</label>
                                <input type="number" name="zip_code" class="form-control" placeholder="Kode Pos">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
