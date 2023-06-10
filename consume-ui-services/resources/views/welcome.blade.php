
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
                <a href="{{ url('/') }}" class="active" aria-label="Toggle navigation">Home</a>
            </li>


        </ul>
    </div> <!-- navbar collapse -->
  </nav>
<!-- End Navbar -->
<div class="container px-0 py-0" id="custom-cards">
  <div class="row">
    <div class="col-12">
        <div class="section-title">
            <h2>Our Services</h2>
            <p>
              
            </p>
        </div>
    </div>
</div>
    <div class="row row-cols-2   row-cols-lg-3 align-items-stretch g-4 py-5">
      <div class="col">
        <a href="{{ url('products') }}">
        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('{{ $photo }}');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold text-dark">Services Product</h3>
            <ul class="d-flex list-unstyled mt-auto">
              <li class="me-auto">
                
              </li>

            </ul>
          </div>
        </div>
        </a>
      </div>

      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('{{ asset('assets/images/auth/auth11.jpg') }}');">
          <a href="{{ url('/login') }}">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-3">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-4 fw-bold text-dark text-shadow-lg">Services Auth</h3>
            <ul class="d-flex list-unstyled mt-auto">


            </a>
            </ul>
          </div>
        </div>
      </div>

      <div class="col">
        <a href="{{ url('/check') }}">
        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('{{ asset('assets/images/rajaongkir/ro2.jpg') }}');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold text-dark">Services Raja Ongkir</h3>
            <ul class="d-flex list-unstyled mt-auto">

            </ul>
          </div>
        </div>
        </a>
      </div>
    </div>
  </div>


<footer class="footer container-fluid bg-transparent text-light">
  <!-- Start Footer Top -->
  <div class="footer-top">
      <div class="container">
          <div class="inner-content">
              <div class="row">
                  <div class="col-lg-3 col-md-4 col-12">
                      <div class="footer-logo">
                          <a href="index.html">
                              <img src="assets/images/logo/logo 1.png" alt="#">
                          </a>
                      </div>
                  </div>
                  <div class="col-lg-9 col-md-8 col-12">
                      <div class="footer-newsletter text-muted">
                          <h4 class="title text-muted">
                              Subscribe to our Newsletter
                              <span class="text-muted">Get all the latest information, Sales and Offers.</span>
                          </h4>
                          <div class="newsletter-form-head">
                              <form action="#" method="get" target="_blank" class="newsletter-form">
                                  <input name="EMAIL" placeholder="Email address here..." type="email">
                                  <div class="button">
                                      <button class="btn">Subscribe<span class="dir-part"></span></button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- End Footer Top -->
  <!-- Start Footer Middle -->
  <div class="footer-middle">
      <div class="container">
          <div class="bottom-inner">
              <div class="row">
                  <div class="col-lg-3 col-md-6 col-12">
                      <!-- Single Widget -->
                      <div class="single-footer f-contact text-muted">
                          <h3 class="text-muted">Get In Touch With Us</h3>
                          <p class="phone">Phone: +1 (900) 33 169 7720</p>
                          <ul>
                              <li><span>Monday-Friday: </span> 9.00 am - 8.00 pm</li>
                              <li><span>Saturday: </span> 10.00 am - 6.00 pm</li>
                          </ul>
                          <p class="mail">
                              <a href="mailto:support@shopgrids.com">support@shopgrids.com</a>
                          </p>
                      </div>
                      <!-- End Single Widget -->
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                      <!-- Single Widget -->
                      <div class="single-footer our-app">
                          <h3 class="text-muted">Our Mobile App</h3>
                          <ul class="app-btn">
                              <li>
                                  <a href="javascript:void(0)">
                                      <i class="lni lni-apple"></i>
                                      <span class="small-title">Download on the</span>
                                      <span class="big-title">App Store</span>
                                  </a>
                              </li>
                              <li>
                                  <a href="javascript:void(0)">
                                      <i class="lni lni-play-store"></i>
                                      <span class="small-title">Download on the</span>
                                      <span class="big-title">Google Play</span>
                                  </a>
                              </li>
                          </ul>
                      </div>
                      <!-- End Single Widget -->
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                      <!-- Single Widget -->
                      <div class="single-footer f-link">
                          <h3 class="text-muted">Information</h3>
                          <ul>
                              <li><a href="javascript:void(0)">About Us</a></li>
                              <li><a href="javascript:void(0)">Contact Us</a></li>
                              <li><a href="javascript:void(0)">Downloads</a></li>
                              <li><a href="javascript:void(0)">Sitemap</a></li>
                              <li><a href="javascript:void(0)">FAQs Page</a></li>
                          </ul>
                      </div>
                      <!-- End Single Widget -->
                  </div>
                  <div class="col-lg-3 col-md-6 col-12">
                      <!-- Single Widget -->
                      <div class="single-footer f-link">
                          <h3 class="text-muted">Shop Departments</h3>
                          <ul>
                              <li><a href="javascript:void(0)">Computers & Accessories</a></li>
                              <li><a href="javascript:void(0)">Smartphones & Tablets</a></li>
                              <li><a href="javascript:void(0)">TV, Video & Audio</a></li>
                              <li><a href="javascript:void(0)">Cameras, Photo & Video</a></li>
                              <li><a href="javascript:void(0)">Headphones</a></li>
                          </ul>
                      </div>
                      <!-- End Single Widget -->
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- End Footer Middle -->
  <!-- Start Footer Bottom -->
  <div class="footer-bottom">

          <div class="inner-content">
              <div class="row align-items-center">
                  <div class="col-lg-4 col-12">
                      <div class="payment-gateway">
                          <span class="text-muted">We Accept:</span>
                          <img src="assets/images/footer/credit-cards-footer.png" alt="#">
                      </div>
                  </div>
                  <div class="col-lg-4 col-12">
                      <div class="copyright">
                          <p class="text-muted">Designed and Developed by<a href="#" rel="nofollow"
                                  target="_blank">Bayu Satrio Trilaksono</a></p>
                      </div>
                  </div>
                  <div class="col-lg-4 col-12">
                      <ul class="socila text-muted">
                          <li>
                              <span class="text-muted">Follow Us On:</span>
                          </li>
                          <li class="text-muted"><a href="javascript:void(0)" class="text-muted"><i class="lni lni-facebook-filled"></i></a></li>
                          <li><a href="javascript:void(0)" class="text-muted"><i class="lni lni-twitter-original"></i></a></li>
                          <li><a href="javascript:void(0)" class="text-muted"><i class="lni lni-instagram"></i></a></li>
                          <li><a href="javascript:void(0)" class="text-muted"><i class="lni lni-google"></i></a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- End Footer Bottom -->
</footer>
@endsection
