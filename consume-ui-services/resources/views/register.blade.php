
@extends('layout.layout')
@section('container')
@if(session()->has('access_token'))
@php
  $name = session('name');
  $email = session('email');
  $password = session('password');
@endphp
        <div class="row mt-5">
            <div class="col-12">
                <div class="section-title">
                    <h2>Anda sudah login, {{ $name }}</h2>
                        <a href="{{ url('/') }}" class="btn btn-light">Back To Home</a>
                </div>
            </div>
        </div>
@else
<form action="{{ route('register') }}" method="post">
    @csrf
    <div class=" d-flex justify-content-center align-items-center"> 

        <img class="mb-4 d-flex justify-content-center align-items-center" src="assets/images/logo/logo 1.png" alt="" >
    </div>
  <h1 class="h3 mb-3 fw-normal">Please Register your Account</h1>

  <div class="form-floating mt-2">
    <input type="text" class="form-control" id="name" name="name" placeholder="John Doe">
    <label for="floatingInput">Full Name</label>
  </div>
  <div class="form-floating mt-2">
    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
    <label for="floatingInput">Email address</label>
  </div>
  <div class="form-floating mt-2">
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    <label for="floatingPassword">Password</label>
  </div>

  <button class="btn btn-primary w-100 py-2 mt-2" type="submit">Register</button>
  <p class="mt-5 mb-3 text-body-secondary">© 2023</p>
</form>

@endif

@endsection

