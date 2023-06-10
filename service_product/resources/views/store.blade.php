

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My-Shop | Product Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
  </head>
  <body>

    <div class="justify-content-center align-items-center container" style="margin-top: 25vh;">
    <h1>Add Product</h1>
        <form method="POST" action="{{ route('product.store') }}" class="w-100" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="mb-3">
            <label for="category_id" class="form-label">Type Categories:</label>
                <select name="id_category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>

                <textarea id="description" name="description"></textarea>

            </div>
            <div class="mb-4">
                    <label for="photo" class="block text-gray-700 font-bold mb-2">Image:</label>
                    <input type="file" name="photo" id="photo" class="form-control @error('photo') border-red-500 @enderror" value="{{ old('photo') }}">


                    @error('photo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            <label for="price" class="form-label">Price:</label>
            <div class="input-group mb-3">
                <span class="input-group-text">Rp.</span>
                <input type="number" class="form-control" name="price" id="price" aria-label="Amount as Rupiah (Indonesian)">
                <span class="input-group-text">.00</span>
      
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock Product:</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>