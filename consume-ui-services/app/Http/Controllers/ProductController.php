<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:8000/api/products');
        $products = $response->json();
        foreach ($products['data'] as $product) {

            $categoryResponse = Http::get('http://localhost:8000/api/categories/' . $product['id_categories']);
            $categoryData = $categoryResponse->json()['name'];
        }
        return view('product', compact('products', 'categoryData'));
    }

    public function downloadProductImage($filename)
    {
        $photoUrl = 'http://localhost:8000/api/products/images/' . $filename;
        $imageContents = Http::get($photoUrl)->body();
        Storage::disk('public')->put('upload/products/' . $filename, $imageContents);

        return response()->file(storage_path('app/public/upload/products/' . $filename));
    }
    
    public function show($id)
    {
     
        $response = Http::get("http://localhost:8000/api/products/{$id}");

        $products = $response->json(); 


        return view('detail_product', compact('products'));

    }

}
