<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Transaction;

use Illuminate\Support\Facades\Redirect;

class PesanProdukController extends Controller
{
    public function pesanProduk(Request $request, $id)
    {
        $transaction = new Transaction;
        $jumlahPesanan = $request->input('quantity');
        
        $response = Http::get('http://localhost:8000/api/products/' . $id); 
        if ($response->successful()) {
            $product = $response->json();
            
            $jumlahPesanan = $request->input('quantity');

            if ($product['stock'] < $jumlahPesanan) {
                return redirect()->back()->with('error', 'Stok produk Kosong atau Tidak ada.');
            }

            $totalHarga = $product['price'] * $jumlahPesanan;
            $newStock = $product['stock'] - $jumlahPesanan;
            
            $transaction->total_price= $totalHarga;
            $updateResponse = Http::put('http://localhost:8000/api/products/' . $id, [
                'stock' => $newStock,
            ]);
            
            $id = $request->id_user;
            $id_categories = $product['id_categories'];
            $id_product = $product['id'];
            $transaction->quantity= $jumlahPesanan;
            $transaction->id_user = $id;
            $transaction->id_product = $id_product;
            $transaction->id_categories= $id_categories;
            
           
            $transaction->save();  

            return redirect('/cart')->with('pesanan', 'Pesanan berhasil dibuat!. Cek Pesanan Anda Kembali.');

        } else {
            return redirect()->back()->with('error', 'Gagal Pesan  produk.');
           
        }
      

        
    }
    public function cart(Request $request)
    {
        $id = $request->session()->get('id');
      
        $transactions = Transaction::where('id_user', $id)->get();
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
        return view('cart' , compact('transactions'));
    }
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
    public function checkout_store(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'address' => 'required',
            'kotaasal' => 'required',
            'kotatujuan' => 'required',
            'weight' => 'required|integer',
            'courier' => 'required',
            'paymentMethod' => 'required',
        ]);

        // Mengambil data transaksi berdasarkan ID
        $transaction = Transaction::find($id);

        // Mengambil data produk menggunakan API atau dari database jika tersedia
        $response = Http::get('http://localhost:8000/api/products/' . $transaction->id_product);
        $productData = $response->json();

        // Menghitung total biaya jasa kirim menggunakan API RajaOngkir
        $origin = $request->kotaasal;
        $destination = $request->kotatujuan;
        $weight = $request->weight;
        $courier = $request->courier;

        $response = Http::post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ]);

        $shippingData = $response->json();
        $shippingCost = $shippingData['results'][0]['costs'][0]['cost'][0]['value'];

        // Menghitung total biaya pemesanan barang
        $totalPrice = $transaction->total_price;
        $totalPayment = $totalPrice + $shippingCost;

        // Menyimpan data checkout ke dalam database atau melakukan tindakan lainnya sesuai kebutuhan

        // Mengirimkan response atau melakukan tindakan lainnya sesuai kebutuhan

        return redirect('/cart')->back()->with('success', 'Berhasil');
    }
    public function checkoutSuccess()
    {
        // Logika dan proses yang diperlukan setelah checkout berhasil
        // Misalnya, menyimpan data transaksi ke database, mengirim email konfirmasi, dll.
        
        // Setelah itu, tampilkan halaman berhasil checkout
        return view('checkout.success');
    }



    
}   
