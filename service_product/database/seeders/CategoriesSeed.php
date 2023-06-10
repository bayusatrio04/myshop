<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
class CategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $category = Categories::create([
                    'name' => 'Fashion',
                    'all_type' => 'Pakaian pria, pakaian wanita, pakaian anak-anak, sepatu, aksesori, tas, dll'
                ]);
                // Kategori Elektronik
                $categoryElektronik = Categories::create([
                    'name' => 'Elektronik',
                    'all_type' => 'Ponsel, laptop, televisi, kamera, perangkat audio, aksesori elektronik, dll'
                ]);
        
                // Kategori Rumah Tangga
                $categoryRumahTangga = Categories::create([
                    'name' => 'Rumah Tangga',
                    'all_type' => 'Peralatan dapur, perabotan, dekorasi, perlengkapan rumah tangga, dll'
                ]);
        
                // Kategori Kecantikan dan Perawatan Pribadi
                $categoryKecantikan = Categories::create([
                    'name' => 'Kecantikan dan Perawatan Pribadi',
                    'all_type' => 'Produk perawatan kulit, perawatan rambut, kosmetik, parfum, dll'
                ]);
        
                // Kategori Olahraga dan Aktivitas Luar Ruangan
                $categoryOlahraga = Categories::create([
                    'name' => 'Olahraga dan Aktivitas Luar Ruangan',
                    'all_type' => 'Peralatan olahraga, pakaian olahraga, peralatan camping, alat olahraga air, dll'
                ]);
        
                // Kategori Makanan dan Minuman
                $categoryMakanan = Categories::create([
                    'name' => 'Makanan dan Minuman',
                    'all_type' => 'Makanan kering, minuman, makanan siap saji, makanan organik, makanan penutup, dll'
                ]);
        
                // Kategori Hobi dan Hiburan
                $categoryHobi = Categories::create([
                    'name' => 'Hobi dan Hiburan',
                    'all_type' => 'Buku, mainan, permainan, alat musik, barang antik, koleksi, dll'
                ]);
        
                // Kategori Otomotif
                $categoryOtomotif = Categories::create([
                    'name' => 'Otomotif',
                    'all_type' => 'Mobil, sepeda motor, suku cadang, aksesori kendaraan, perawatan dan pemeliharaan kendaraan, dll'
                ]);
        
                // Kategori Perangkat Lunak dan Teknologi
                $categoryPerangkatLunak = Categories::create([
                    'name' => 'Perangkat Lunak dan Teknologi',
                    'all_type' => 'Aplikasi perangkat lunak, layanan web, perangkat keras komputer, aksesori teknologi, dll'
                ]);
        
                // Kategori Alat dan Peralatan
                $categoryAlat = Categories::create([
                    'name' => 'Alat dan Peralatan',
                    'all_type' => 'Alat pertukangan, peralatan taman, peralatan listrik, peralatan industri, dll'
                ]);
    }
}
