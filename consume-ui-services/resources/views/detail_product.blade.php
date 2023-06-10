
@extends('layout.layout')
    @section('container')
        <h1>Products</h1>
        
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-5">

            <div class="col">
                <div class="card">
                    <img src="{{ $products['photo'] }}" class="card-img-top" alt="...">
                    <div class="card-body">

                            <h5 class="card-title d-flex justify-content-start align-items-start">{{ $products['name']}}</h5>
                            <div class="d-flex justify-content-end align-items-end">

                                <h5>Rp{{ number_format($products['price'], 0, ',', '.') }}</h5>
                            </div>
                        <p class="card-text">{!! $products['description'] !!} </p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="bg-white shadow p-5 rounded" style="height:50vh;">
                    <h3 class="text-secondary mb-5">Pesan Sekarang</h3>
                    <div>Ready Stock : {{ $products['stock'] }}</div>
                    @if(session()->has('access_token'))
                    @php
                        $id_user = session('id');
                        $name = session('name');
                        $email = session('email');
                        $password = session('password');
                    @endphp
                    <form action="{{ route('pesan.produk', ['id' => $products['id']]) }}" method="post" class="form-group">
                        @csrf
                        <div class="form-outline">
                            <label class="form-label" for="typeNumber">Jumlah Pesanan :</label><br>
                            <input type="hidden" id="id_user" name="id_user" value="{{ $id_user }}">
                            <input type="number" id="quantity" name="quantity" class="form-control" />
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 form-control w-100">Masukkan Pesanan</button>
                    </form>

                    @else
                        <div class="alert alert-danger mt-3" role="alert">
                        Anda Belom Melakukan Login.
                        </div>
                        <div class="d-flex gap-3">
                            <a href="{{ url('/login') }}" class="btn btn-light" id="loginButton">Login</a>
                            <a href="{{ url('/register') }}" class="btn btn-light" id="registerButton">Register</a>
                        </div>
                    @endif

                </div>
            </div>
            
     
        </div>


    @endsection
