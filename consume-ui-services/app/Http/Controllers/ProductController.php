<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\View;
use App\Models\Transaction;
class ProductController extends Controller
{
    public function index(Request $re)
    {
        $response = Http::get('http://localhost:8000/api/products');
        $products = $response->json();
        foreach ($products['data'] as $product) {

            $categoryResponse = Http::get('http://localhost:8000/api/categories/' . $product['id_categories']);
            $categoryData = $categoryResponse->json()['name'];
        }
        $id_user = request()->session()->get('id');
        $transactions = [
            Transaction::where('id_user', $id_user)->get(),
            $count = Transaction::where('id_user', $id_user)->count(),
        ];

        foreach ($transactions[0] as $transaction) {

            $response = Http::get('http://localhost:8000/api/products/' . $transaction->id_product);
            $productData = $response->json();


            $name = request()->session()->get('name');
            $email = request()->session()->get('email');
            $userData = $name;
            $emailData = $email;


            $categoryResponse = Http::get('http://localhost:8000/api/categories/' . $transaction->id_categories);
            $categoryData = $categoryResponse->json()['name'];

            $transaction['photo'] = $productData['photo'];
            $transaction['product_name'] = $productData['name'];
            $transaction['user_name'] = $userData;
            $transaction['user_email'] = $emailData;
            $transaction['category_name'] = $categoryData;

        }

        foreach ($transactions as $items){

            session(['items'=> $transactions]);
        }
        session(['transactions'=>$transactions]);
        // dd($transactions);

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
