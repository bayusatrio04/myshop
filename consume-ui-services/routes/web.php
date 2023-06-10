<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Mengambil detail produk dengan ID 14 dari API server
    $response = Http::get('http://localhost:8000/api/products/14');

    if ($response->status() === 200) {
        $product = $response->json();

        if (isset($product['photo'])) {
            $photo = $product['photo'];
        } else {
            // Jika tidak ada atribut gambar yang sesuai, berikan nilai default
            $photo = 'default.jpg';
        }

        // Mengirim data foto ke view welcome
        return view('welcome', ['photo' => $photo]);
    }

    // Jika gagal mengambil data dari API, tampilkan halaman welcome tanpa foto
    return view('welcome');
})->middleware('guest');

Route::get('/login', function () {
    return view('login');
});




use App\Http\Controllers\AuthController;

Route::view('/register', 'register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::view('/login', 'login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/authenticated-user', [AuthController::class, 'authenticatedUser']);
});


// Route::get('/register', function () {
//     $response = Http::post('http://localhost:7000/api/register', [
//         'name' => 'user 2',
//         'email' => 'user2@example.com',
//         'password' => '123456',
//     ]);

//     if ($response->successful()) {
//         // Registrasi berhasil
//         $responseData = $response->json();
//         // Lakukan tindakan selanjutnya, seperti menyimpan token atau memberikan respons kepada pengguna
//         return response()->json($responseData);
//     } else {
//         // Registrasi gagal
//         $errorMessage = $response->json('message');
//         // Tangani kesalahan, seperti menampilkan pesan kesalahan atau memberikan respons yang sesuai
//         return response()->json(['error' => $errorMessage], 400);
//     }
// });


// Route::post('/login', function () {
    //     $email = request()->input('email');
    //     $password = request()->input('password');
    
    //     $response = Http::post('http://localhost:7000/api/login', [
        //         'email' => $email,
        //         'password' => $password,
        //     ]);
        
        //     if ($response->successful()) {
            //         request()->session()->regenerate();
            //         $accessToken = $response->json()['access_token'];
            
            //         // Simpan access token di cookie atau local storage, misalnya
            //         // Set cookie
            //         return redirect()->intended('/')->cookie('access_token', $accessToken)->with('access_token', $accessToken);
            
            //         // Set local storage
            //         // return redirect('/')->with('access_token', $accessToken);
            //     } else {
                //         // Redirect kembali ke /login jika login gagal
                //         $errorMessage = $response->json('message');
                //         return response()->json(['error' => $errorMessage], 400);
                //     }
// })->name('login');

// Route::get('/consume-api', function () {
    //     $response = Http::post('http://localhost:7000/api/login', [
        //         'email' => 'user2@example.com',
        //         'password' => '123456'
        //     ]);
        
        //     $responseData = $response->json();
        
        //     if (isset($responseData['access_token'])) {
            //         return redirect('/')->with('access_token', $responseData['access_token']);
            //     } else {
                //         // Tangani kasus ketika tidak ditemukan access_token dalam respons
                //         return redirect('/login')->with('error', 'Failed to obtain access token');
                //     }
                // });
                // Route::get('/consume-api', function () {
                    //     $response = Http::post('http://localhost:7000/api/login', [
                        //         'email' => 'user2@example.com',
                        //         'password' => '123456'
                        //     ]);
                        
                        //     return $response->json();
                        // });
                        
                        
                        // Route::post('/logout', function () {
                            //     $accessToken = request()->cookie('access_token');
                            
                            //     $response = Http::withHeaders([
                                //         'Authorization' => 'Bearer ' . $accessToken,
                                //     ])->post('http://localhost:7000/api/logout');
                                
                                //     if ($response->successful()) {
                                    //         // Hapus access token dari cookie atau local storage, misalnya
                                    //         // Hapus cookie
                                    //         return response()->json(['message' => 'You have been logged out successfully'])->cookie('access_token', '', 0);
                                    
                                    //         // Hapus local storage
                                    //         // return response()->json(['message' => 'You have been logged out successfully'])->withCookie(cookie()->forget('access_token'));
                                    //     } else {
                                        //         return response()->json(['message' => 'Logout failed'], 400);
//     }
// })->name('logout');

Route::post('/payment/notification', [PaymentController::class, 'notification']);


Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.detail');

Route::get('/products/images/{filename}', [ProductController::class, 'downloadProductImage'])->name('products.images');

use App\Http\Controllers\PesanProdukController;
use App\Http\Controllers\RajaOngkirController;

Route::post('/pesan_produk/{id}', [PesanProdukController::class, 'pesanProduk'])->name('pesan.produk');

Route::get('/cart', [PesanProdukController::class, 'cart'])->name('cart.produk');
Route::get('/checkout/{id}', [PesanProdukController::class, 'checkout'])->name('checkout.produk');
Route::post('/checkout/{id}', [PesanProdukController::class, 'checkout_store'])->name('checkout.store');
Route::get('/checkout/success', [PesanProdukController::class, 'checkoutSuccess'])->name('checkout.success');


Route::get('/check', [RajaOngkirController::class, 'check'])->name('check.ongkir');
Route::post('/check', [RajaOngkirController::class, 'calculateShippingCost'])->name('proses.check');
Route::get('/cities', [RajaOngkirController::class, 'getCities']);