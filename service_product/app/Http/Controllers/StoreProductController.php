<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Facades\Hash;
use Storage;

class StoreProductController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return view('store', ['title'=>'My-Shop | Store Product'], compact('categories'));
    }
    public function show()
    {
        $products = Product::all();
        return view('show', ['title'=>'My-Shop | All Product'], compact('products'));
    }
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->id_categories = $request->input('id_category');
        $product->stock = $request->input('stock');
    
        // $photo = $request->file('photo');
        // $photo->store('upload/products', ['disk' => 'public_uploads']);
        
        // $product->photo = $photo->hashName();
    
        $photo = $request->file('photo');
        $filename = $photo->hashName();
        $photo->storeAs('public/upload/products', $filename);

    
        $product->photo = url('storage/upload/products/' . $filename);
        $product->save();

        
    
        


        $product->save();
    
        return redirect('/service_product/detail')->with('success', 'Success Add Product dengan ID Product: #' . $product->id);
    }
    
    
}
