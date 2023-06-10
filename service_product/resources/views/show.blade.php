

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My-Shop | Product Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class=" justify-content-start align-items-center container" style="margin-top: 25vh;">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <h1>All - Product</h1>
        <div class="d-flex justify-content-end align-items-end">
            <a href="{{ url('/service_product') }}" class="btn btn-primary mb-3">Add Product</a>
        </div>
       
        <table class="table">
            <thead class="table-dark">
                <th>#ID</th>
                <th>Photo Product</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </thead>
            <tbody>

                @forelse ($products as $item)
                @php
                    $photoUrl = $item['photo'];
                    $filename = substr($photoUrl, strpos($photoUrl, 'products/') + strlen('products/'));
                @endphp

                <tr>
                    <td>{{ $item->id }}</td>
                    
                    <td><img src="{{ asset('storage/upload/products/'. $filename) }}" width="100vh"height="300px" alt=""></td>
                    <td>{{ $item->name }}</td>
                    <td>{!! Str::limit(strip_tags($item->description), 80) !!}</td>
                    <td> Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>
                        <a href="">Detail</a>
                        <a href="">Edit</a>
                        <a href="">Delete</a>
                    </td>
                    @empty
                    <td colspan="5" class="text-center pt-5 mb-5">Product Data Not Found. Please add product first</td>
                </tr>
                @endforelse
            </tbody>
        </table>
            
      
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>