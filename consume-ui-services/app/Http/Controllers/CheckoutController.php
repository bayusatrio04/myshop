<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    // ...

    public function checkout(Request $request, $id){
        $id_user = $request->session()->get('id');
        $count = Transaction::where('id', $id)->count();
        $transactions = Transaction::where('id', $id)->get();


        $response = Http::withHeaders([
            'key' => 'b301ab3cc1a3fa7a3f48e75ee35afca5' // Ganti dengan API key Anda
        ])->get('https://api.rajaongkir.com/starter/city');

        $cities = $response->json()['rajaongkir']['results'];

        foreach ($transactions as $transaction) {

            $response = Http::get('http://localhost:8000/api/products/' . $transaction->id_product);
            $productData = $response->json();


            $name = $request->session()->get('name');
            $email = $request->session()->get('email');
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

        return view('checkout' , compact('transactions', 'count', 'cities'));
    }
    public function store(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'address' => 'required',
            'kotaasal' => 'required',
            'kotatujuan' => 'required',
            'weight' => 'required',
            'courier' => 'required',
            'paymentMethod' => 'required',
        ]);

        // Dapatkan data transaksi berdasarkan ID yang diterima
        $transaction = Transaction::find($id);

        // Simpan data yang diinput ke dalam model transaksi
        $transaction->fullname = $request->input('fullname');
        $transaction->email = $request->input('email');
        $transaction->address = $request->input('address');
        $transaction->kotaasal = $request->input('kotaasal');
        $transaction->kotatujuan = $request->input('kotatujuan');
        $transaction->weight = $request->input('weight');
        $transaction->courier = $request->input('courier');
        $transaction->paymentMethod = $request->input('paymentMethod');

        $transaction->status = "Completed";
        // Simpan perubahan pada transaksi
        $transaction->save();

        // Tambahkan logika lain yang diperlukan, seperti menghitung total biaya, mengirim email konfirmasi, dll.

        // Redirect atau kembalikan respon sesuai kebutuhan
        return redirect('/cart')->with('pesanan', 'Checkout Barang berhasil.Silahkan Tunggu Proses Pengiriman Barang.');
    }

    public function checkoutAll(Request $request)
    {
        // ...
        $count = Transaction::all()->count();
        $transactions = Transaction::all();
        $response = Http::withHeaders([
            'key' => 'b301ab3cc1a3fa7a3f48e75ee35afca5' // Ganti dengan API key Anda
        ])->get('https://api.rajaongkir.com/starter/city');

        $cities = $response->json()['rajaongkir']['results'];

        foreach ($transactions as $transaction) {
            $response = Http::get('http://localhost:8000/api/products/' . $transaction->id_product);
            $productData = $response->json();

            $name = $request->session()->get('name');
            $email = $request->session()->get('email');
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

        return view('checkout-all', compact('transactions', 'cities', 'count'));
    }

    // ...
}

