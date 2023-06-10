
@extends('layout.layout')
    @section('container')
      <!-- Start Navbar -->
        <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                <ul id="nav" class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="" aria-label="Toggle navigation">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="" aria-label="Toggle navigation">>></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/cart') }}" class="active" aria-label="Toggle navigation">Carts</a>
                    </li>


                </ul>
            </div> <!-- navbar collapse -->
        </nav>
        <!-- End Navbar -->
   
        <div class="row mt-5">
            <div class="col-12">
                <div class="section-title">
                    <h2>Your Carts</h2>
                    <p>
                        If you want to checkout the item. Click the Checkout button. If you don't want to checkout the item, click the Cancel button.
and if you want to buy other items then click the item order button
                    </p>
                </div>
            </div>
        </div>
        @if(session('pesanan'))
            <div class="alert alert-success mt-3">
                {{ session('pesanan') }}
            </div>
        @endif
        @forelse($transactions as $cart)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#ID TRANSAKSI</th>
                    <th scope="col">ID USER</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PRODUCT NAME</th>
                    <th scope="col">PHOTO PRODUCT</th>
                    <th scope="col">CATEGORIES NAME</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">TOTAL PRICE</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <th scope="row">{{ $cart->id }}</th>
                    <td>{{ $cart->id_user }}</td>
                    <td>{{ $cart->user_name }}</td>
                    <td>{{ $cart->user_email}}</td>
                    <td>{{ $cart->product_name }}</td>
                    <td>
                        <img src="{{ $cart->photo }}" class="card-img-top w-25" alt="...">
                    </td>
                    <td>{{ $cart->category_name }}</td>
                    <td>{{ $cart->quantity }}</td>
                    <td>Rp{{ number_format($cart->total_price, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('checkout.produk', ['id' => $cart['id']]) }}" class="btn btn-primary">Checkout</a>
                        <a href="" class="btn btn-danger mt-3">Cancel</a>
                    </td>
   
                    @empty
                    <td>Data Transaksi Belum ada.</td>
                </tr>
               
            </tbody>
        </table>
        @endforelse


@endsection
