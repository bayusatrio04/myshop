
@extends('layout.layout')
@section('container')

    <div class="d-flex  justify-content-center align-items-center py-4 bg-body-tertiary">
        <main class="form-signin w-100 m-auto">
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
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class=" d-flex justify-content-center align-items-center"> 

                    <img class="mb-4 d-flex justify-content-center align-items-center" src="assets/images/logo/logo 1.png" alt="" >
                </div>
              <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
          
              <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mt-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
          
              <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Remember me
                </label>
              </div>
              <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
              <p class="mt-5 mb-3 text-body-secondary">© 2023</p>
            </form>
            @endif
        </main>
    </div>


@endsection

