<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class RajaOngkirController extends Controller
{
    public function check()
    {
 

        $response = Http::withHeaders([
            'key' => 'b301ab3cc1a3fa7a3f48e75ee35afca5', // Ganti dengan API key Anda dari RajaOngkir
        ])->get('https://api.rajaongkir.com/starter/city');

        if ($response->successful()) {
            $result = $response->json();
            $cities = $result['rajaongkir']['results'];

        } else {
            $error = $response->json();
        }
        return view('rajaongkir', compact('cities'));
    }

    public function getCities()
    {

    }

    public function calculateShippingCost(Request $request)
    {
        // Validasi input
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required',
            'courier' => 'required',
        ]);

        // Ambil nilai input dari formulir
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $weight = $request->input('weight');
        $courier = $request->input('courier');

        // Buat payload untuk dikirim ke API RajaOngkir
        $payload = [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier,
        ];

        // Kirim permintaan POST ke API RajaOngkir
        $response = Http::withHeaders([
            'key' => 'b301ab3cc1a3fa7a3f48e75ee35afca5', // Ganti dengan API key Anda dari RajaOngkir
        ])->post('https://api.rajaongkir.com/starter/cost', $payload);

        if ($response->successful()) {
            $result = $response->json(); // Hasil perhitungan biaya pengiriman
            return redirect()->route('check.ongkir')->with('shipping_cost', $result);
        } else {
            $error = $response->json(); // Kesalahan saat mengirim permintaan
            // Tangani kesalahan yang terjadi
            return $error;
        }
        
    }
}
