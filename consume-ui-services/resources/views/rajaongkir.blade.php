
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
            <h2>Checking Your Destination Calculator</h2>
           
        </div>
    </div>
</div>
        <div class="row g-5">
            <div class="col-md-12">
    
              <form class="needs-validation" novalidate method="post" action="{{ route('proses.check') }}">
                @csrf
    
                <div class="form-group">
                    <label for="origin">Kota Asal</label>
                    <select class="form-control" id="origin" name="origin" required>
                        @foreach ($cities as $city)
                            <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <label for="destination">Kota Tujuan</label>
                    <select class="form-control" id="destination" name="destination" required>
                        @foreach ($cities as $city)
                            <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" class="form-control" id="weight" name="weight" required>
                </div>
    
                <div class="form-group">
                    <label for="courier">Courier</label>
                    <select class="form-control" id="courier" name="courier" required>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS Indonesia</option>
                    </select>
                </div>
    
                <button type="submit" class="btn btn-primary mt-3">Calculate</button>
            </form>
            </div>
          </div>
          @if (session('shipping_cost'))
          @php
              $result = session('shipping_cost');
          @endphp
          <h2 class="mt-5">Shipping Cost Result</h2>
          <table class="table">
              <thead>
                  <tr>
                      <th>Service</th>
                      <th>Description</th>
                      <th>Cost</th>
                      <th>Estimated Delivery Time</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($result['rajaongkir']['results'] as $resultItem)
                      @foreach ($resultItem['costs'] as $cost)
                          <tr>
                              <td>{{ $resultItem['name'] }}</td>
                              <td>{{ $cost['description'] }}</td>
                              <td>{{ $cost['cost'][0]['value'] }}</td>
                              <td>{{ $cost['cost'][0]['etd'] }}</td>
                          </tr>
                      @endforeach
                  @endforeach
              </tbody>
          </table>
      @endif
      
      @if (isset($error))
          <div class="alert alert-danger" role="alert">
              Error: {{ $error['rajaongkir']['status']['description'] }}
          </div>
      @endif
    </div>
</div>
<script>
    // Autocomplete for origin and destination
    $(document).ready(function() {
        $.ajax({
            url: '/cities',
            method: 'GET',
            success: function(response) {
                var cities = response;
                var options = '';
                cities.forEach(function(city) {
                    options += '<option value="' + city.city_id + '">' + city.city_name + '</option>';
                });
                $('#origin, #destination').html(options);
            }
        });
    });
</script>
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
