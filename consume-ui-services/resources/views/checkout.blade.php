
@extends('layout.layout')
<head>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LineIcons.3.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
</head>
@section('container')
<div class="row">
    <div class="col-12">
        <div class="section-title">
            <h2>Checkout Form</h2>

        </div>
    </div>
</div>
@foreach ($transactions as $transaction)
<div class="row g-5">

    <div class="col-md-5 col-lg-4 order-md-last">

      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Your cart</span>
        <span class="badge bg-primary rounded-pill">{{ $count }}</span>
      </h4>
      <h4>
        <img src="{{ $transaction->photo }}" alt="">
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h6 class="my-0">Product name</h6>
            <small class="text-muted">{{ $transaction->product_name }}</small>
          </div>
          <span class="text-muted">Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Status Pemesanan</h6>
              <small class="text-muted">

            </small>
            </div>
            <span class="text-muted">
                @if($transaction->status == "Pending")
                <td><span class="badge text-bg-danger">{{ $transaction->status }}</span></td>
                @else
                <td><span class="badge text-bg-success">{{ $transaction->status }}</span></td>
                @endif
            </span>
          </li>
        <li class="list-group-item d-flex justify-content-between">
          <strong>Total Pembayaran(Rupiah)</strong>
          <strong>Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>
        </li>
      </ul>

    </div>




    <div class="col-md-7 col-lg-8">
        <a href="{{ url('/cart') }}" class="btn btn-dark mb-3 mt-3">Back</a>
      <h4 class="mb-3">Billing Transaction ID <strong>#{{ $transaction->id }}</strong></h4>
      <form action="{{ route('checkout.store', $transaction->id) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate="">
        @csrf
        <div class="row g-3">
          <div class="col-sm-12">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="" value="{{ $transaction->user_name }}" readonly>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>



          <div class="col-12">
            <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="" value="{{ $transaction->user_email }}" readonly  >
            <div class="invalid-feedback">
              Please enter a valid email address for shipping updates.
            </div>
          </div>
          @if($transaction->status == "Completed")
            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $transaction->address }}" readonly>
                    <div class="invalid-feedback">
                    Please enter your shipping address.
                    </div>
            </div>
            <div class="col-12">
                <label for="kotaasal" class="form-label">Kota Asal</label>
                <input type="text" class="form-control" id="kotaasal" name="kotaasal" value="{{ $transaction->kotaasal }}" readonly>
                    <div class="invalid-feedback">
                    Please enter your shipping address.
                    </div>
            </div>
            <div class="col-12">
                <label for="kotatujuan" class="form-label">Kota Tujuan</label>
                <input type="text" class="form-control" id="kotatujuan" name="kotatujuan" value="{{ $transaction->kotatujuan }}" readonly>
                    <div class="invalid-feedback">
                    Please enter your shipping address.
                    </div>
            </div>
            <div class="col-12">
                <label for="weight" class="form-label">Berat Product</label>
                <input type="text" class="form-control" id="weight" name="weight" value="{{ $transaction->weight }}" readonly>
                    <div class="invalid-feedback">
                    Please enter your shipping address.
                    </div>
            </div>
            <div class="col-12">
                <label for="courier" class="form-label">Jasa Pengiriman</label>
                <input type="text" class="form-control" id="courier" name="courier" value="{{ $transaction->courier }}" readonly>
                    <div class="invalid-feedback">
                    Please enter your shipping address.
                    </div>
            </div>
            <div class="col-12">
                <label for="paymentMethod" class="form-label">Payment Method</label>
                <p>{{ $transaction->paymentMethod }}</p>
            </div>
          @else
            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
                <div class="invalid-feedback">
                Please enter your shipping address.
                </div>
            </div>



          <div class="col-md-5">
            <label for="kotaasal"  class="form-label">Kota Asal:</label>
            <select class="form-select" id="kotaasal" name="kotaasal" required="">
                @foreach ($cities as $city)
                <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback">
              Please select a valid kota asal.
            </div>
          </div>

          <div class="col-md-5">
            <label for="kotatujuan"  class="form-label">Kota Tujuan:</label>
            <select class="form-select" id="kotatujuan" name="kotatujuan" required="">
                @foreach ($cities as $city)
                <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback">
              Please select a valid kota tujuan.
            </div>
          </div>


          <div class="col-md-12">
            <label for="weight">Berat (gram):</label>
            <input type="text" class="form-control" name="weight" id="weight">
          </div>

          <div class="col-md-12">
            <label for="courier">Kurir:</label>
            <select name="courier" class="form-select" id="courier">
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">POS Indonesia</option>
                <!-- Tambahkan pilihan kurir lainnya sesuai kebutuhan -->
              </select>
          </div>



        <hr class="my-4">

        <h4 class="mb-3">Payment</h4>

        <div class="my-3">
          <div class="form-check">
            <input id="credit" name="paymentMethod" value="OVO" type="radio" class="form-check-input" checked="" required="">
            <label class="form-check-label"  for="credit">OVO</label>
          </div>
          <div class="form-check">
            <input id="debit" name="paymentMethod"  value="GOPAY" type="radio" class="form-check-input" required="">
            <label class="form-check-label" for="debit">GOPAY</label>
          </div>
          <div class="form-check">
            <input id="paypal" name="paymentMethod" value="LINK AJA" type="radio" class="form-check-input" required="">
            <label class="form-check-label" for="paypal">LINK AJA</label>
          </div>
        </div>


        <hr class="my-4">

        <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
      </form>
      @endif

    </div>
  </div>
  @endforeach

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
