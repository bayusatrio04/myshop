<head>
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
</head>

<header class="header navbar-area">
  <!-- Start Topbar -->
  <div class="topbar">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-4 col-md-4 col-12">
                  <div class="top-left">
                  </div>
              </div>
              <div class="col-lg-4 col-md-4 col-12">
                  <div class="top-middle">
                      <ul class="useful-links">
                          <li><a href="{{ url('/') }}">Home</a></li>
                          <li><a href="{{ url('/products') }}">Products</a></li>
                          <li><a href="{{ url('/cart') }}">Cart</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-4 col-md-4 col-12">
                  <div class="top-end">
                    @if(session()->has('access_token'))
                    @php
                      $name = session('name');
                      $email = session('email');
                      $password = session('password');
                    @endphp
                    <div class="user d-flex align-baseline ms-auto gap-3">

                      <span class="ms-auto mt-2"><i class="lni lni-user"></i> Hello, {{ $name }}</span>
                      <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-dark text-primary gap-3">Logout</button>
                      </form>
                    </div>
                  @else
                      <ul class="user-login">
                          <li>
                              <a href="{{ url('/login') }}">Sign In</a>
                          </li>
                          <li>
                              <a href="{{ url('/register') }}">Register</a>
                          </li>
                      </ul>
                    @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- End Topbar -->
  <!-- Start Header Middle -->
  <div class="header-middle">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-3 col-md-3 col-7">
                  <!-- Start Header Logo -->
                  <a class="navbar-brand" href="{{ url('/') }}">
                      <img src="{{ asset('assets/images/logo/logo 1.png') }}" alt="Logo">
                  </a>
                  <!-- End Header Logo -->
              </div>
              <div class="col-lg-5 col-md-7 d-xs-none">
                  <!-- Start Main Menu Search -->
                  <div class="main-menu-search">
                      <!-- navbar search start -->
                      <div class="navbar-search search-style-5">
                          <div class="search-select">
                              <div class="select-position">
                                  <select id="select1">
                                      <option selected>All</option>
                                      <option value="1">option 01</option>
                                      <option value="2">option 02</option>
                                      <option value="3">option 03</option>
                                      <option value="4">option 04</option>
                                      <option value="5">option 05</option>
                                  </select>
                              </div>
                          </div>
                          <div class="search-input">
                              <input type="text" placeholder="Search">
                          </div>
                          <div class="search-btn">
                              <button><i class="lni lni-search-alt"></i></button>
                          </div>
                      </div>
                      <!-- navbar search Ends -->
                  </div>
                  <!-- End Main Menu Search -->
              </div>
              <div class="col-lg-4 col-md-2 col-5">
                  <div class="middle-right-area">
                      <div class="nav-hotline">

                      </div>
                      @php
                      $cart = session('transactions');
                      $items = session('items');
                      @endphp

                      <div class="navbar-cart d-flex right-0 justify-content-end align-items-end ">
                          <div class="cart-items text-danger">
                              <a href="javascript:void(0)" class="main-btn">
                                  <i class="lni lni-cart mt-2"></i>
                                  <span class="total-items bg-danger">{{ $cart[1] }}</span>
                              </a>
                              <!-- Shopping Item -->
                              <div class="shopping-item">
                                  <div class="dropdown-cart-header">
                                      <span>{{ $cart[1] }} Items</span>
                                      <a href="{{ url('/cart') }}">View Cart</a>
                                  </div>
                                  <ul class="shopping-list">
                                    @if($cart)
                                    @foreach($cart[0] as $item)

                                        <li>
                                            <a href="javascript:void(0)" class="remove" title="Remove this item"><i class="lni lni-close"></i></a>
                                            <div class="cart-img-head">
                                                <a class="cart-img" href="product-details.html"><img src="{{ $item->photo }}" alt="#"></a>
                                            </div>
                                            <div class="content">
                                                <h4><a href="product-details.html">{{ $item->product_name }}</a></h4>
                                                <p class="quantity">{{ $item->quantity }} x - <span class="amount">Rp.{{ number_format($item->total_price, 0, ',', '.') }}</span></p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                                  </ul>

                                  <div class="bottom">
                                      <div class="total">
                                          <span>Total</span>
                                          @php
                                                $totalPrice = 0;
                                                foreach ($cart[0] as $item) {
                                                    $totalPrice += $item->total_price;
                                                }
                                            @endphp
                                          <span class="total-amount">Rp.{{ number_format($totalPrice, 0, ',', '.') }}</span>
                                      </div>

                                      @forelse ($cart[0] as $item)
                                      <div class="button">
                                        <a href="{{ route('checkout.all') }}" class="btn animate">Checkout</a>
                                      </div>
                                      @empty
                                      <p>Tidak ada Transaksi</p>
                                      @endforelse


                                  </div>
                              </div>
                              <!--/ End Shopping Item -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


  <!-- End Header Middle -->
  <!-- Start Header Bottom -->
  <div class="container">
      <div class="row align-items-center">
          <div class="col-lg-8 col-md-6 col-12">
              <div class="nav-inner">
                  <!-- Start Mega Category Menu -->

                  <!-- End Mega Category Menu -->

              </div>
          </div>

          </div>
      </div>
  </div>
  <!-- End Header Bottom -->
</header>

<script>
  // Cek keberadaan access_token
  var access_token = localStorage.getItem('access_token');

  if (access_token) {

    document.getElementById('loginButton').style.display = 'none';
    document.getElementById('registerButton').style.display = 'none';
  } else {

    document.getElementById('loginButton').style.display = 'block';
    document.getElementById('registerButton').style.display = 'block';
  }
</script>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script type="text/javascript">
    //========= Hero Slider
    tns({
        container: '.hero-slider',
        slideBy: 'page',
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 0,
        items: 1,
        nav: false,
        controls: true,
        controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
    });

    //======== Brand Slider
    tns({
        container: '.brands-logo-carousel',
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 15,
        nav: false,
        controls: false,
        responsive: {
            0: {
                items: 1,
            },
            540: {
                items: 3,
            },
            768: {
                items: 5,
            },
            992: {
                items: 6,
            }
        }
    });
</script>
