
    @extends('layout.layout')
    <head>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    </head>
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
                <a href="{{ url('/products') }}" class="active" aria-label="Toggle navigation">Products</a>
            </li>


        </ul>
    </div> <!-- navbar collapse -->
  </nav>
<!-- End Navbar -->


            <!-- Start Trending Product Area -->
            <section class="trending-product section" style="margin-top: 12px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-title">
                                <h2>Our Product</h2>
                                <p>There is a wide variety of our Products section available, but most have undergone some form of modification. but still our product is of high quality.</p>
                            </div>
                        </div>
                    </div>
                    <style>
                        .product-photo {
                        width: 200px !important; /* Ganti dengan lebar yang diinginkan */
                        height: 500px !important; /* Ganti dengan tinggi yang diinginkan */
                        object-fit: cover;
}
                    </style>
                    <div class="row">
                        @foreach ($products['data'] as $product)
                        <div class="col-lg-3 col-md-6 col-12">

                            <!-- Start Single Product -->
                            <div class="single-product ">
                                <div class="product-image">
                                    <img src="{{ $product['photo'] }}" class="" alt="#">
                                    <span class="new-tag">New</span>
                                    <div class="button">
                                        <a href="{{ route('product.detail', ['id' => $product['id']]) }}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product-info product-foto">

                                    <span class="category">{{ $categoryData }}</span>

                                    <h4 class="title">
                                        <a href={{ route('product.detail', ['id' => $product['id']]) }}">{{ $product['name'] }}</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><span>5.0 Review(s)</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>Rp.{{ number_format($product['price'], 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Product -->

                        </div>
                        @endforeach

                    </div>
                </div>
            </section>
            <!-- End Trending Product Area -->
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
    @endsection
