<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'data' => $products
        ], 200, [], JSON_PRETTY_PRINT);
    }

    
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        return response()->json($product, 201);
    }
    
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
    
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        return response()->json($product);
    }

    public function getProductImage($filename)
    {
        $filePath = 'upload/products/' . $filename;

        if (Storage::disk('public')->exists($filePath)) {
            $image = Storage::disk('public')->get($filePath);
            $contentType = Storage::disk('public')->mimeType($filePath);

            return response($image)->header('Content-Type', $contentType);
        }

        return response()->json(['error' => 'Image not found'], 404);
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
    
}
