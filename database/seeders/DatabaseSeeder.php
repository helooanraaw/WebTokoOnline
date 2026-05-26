<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing categories and products to avoid duplication/conflicts
        Product::query()->delete();
        Category::query()->delete();

        // Admin Account
        User::updateOrCreate(
            ['email' => 'admin@sekolah.com'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Customer Account
        User::updateOrCreate(
            ['email' => 'customer@sekolah.com'],
            [
                'name' => 'Customer SMK',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        // Categories and Products
        $categoriesData = [
            'iPhone Pro' => [
                [
                    'name' => 'iPhone 15 Pro Max',
                    'description' => 'Desain titanium tangguh dan ringan. Dilengkapi tombol Tindakan baru, sistem kamera iPhone paling andal dengan zoom optik 5x, dan chip A17 Pro yang bertenaga.',
                    'price' => 24999000,
                    'promo_price' => 22999000,
                    'stock' => 15,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'iphone_15_pro_max.jpg'
                ],
                [
                    'name' => 'iPhone 15 Pro',
                    'description' => 'Titanium tingkat dirgantara dengan bagian belakang kaca matte bertekstur. Dilengkapi kamera utama 48 MP yang memukau dan port USB-C dengan kecepatan USB 3.',
                    'price' => 20999000,
                    'promo_price' => null,
                    'stock' => 20,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1695048133031-c0062a4fa969?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'iphone_15_pro.jpg'
                ],
                [
                    'name' => 'iPhone 14 Pro Max',
                    'description' => 'Cara baru yang ajaib untuk berinteraksi dengan iPhone lewat Dynamic Island. Layar Super Retina XDR yang Selalu Aktif dengan ProMotion, dan kamera 48 MP.',
                    'price' => 19999000,
                    'promo_price' => 18499000,
                    'stock' => 8,
                    'is_new' => false,
                    'image_url' => 'https://images.unsplash.com/photo-1678652197831-2d180705cd2c?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'iphone_14_pro_max.jpg'
                ]
            ],
            'iPhone' => [
                [
                    'name' => 'iPhone 15',
                    'description' => 'Menghadirkan Dynamic Island, kamera Utama 48 MP, dan USB-C, semuanya dalam desain kaca berwarna yang tangguh dan aluminium.',
                    'price' => 16499000,
                    'promo_price' => 14999000,
                    'stock' => 30,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1592899677977-9c10ca588bbd?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'iphone_15.jpg'
                ],
                [
                    'name' => 'iPhone 15 Plus',
                    'description' => 'Desain layar 6,7 inci yang lebih besar dengan Dynamic Island, ketahanan baterai yang luar biasa sepanjang hari, kamera Utama 48 MP, dan USB-C.',
                    'price' => 18499000,
                    'promo_price' => null,
                    'stock' => 15,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'iphone_15_plus.jpg'
                ],
                [
                    'name' => 'iPhone 13',
                    'description' => 'Sistem kamera ganda paling canggih yang pernah ada di iPhone. Chip A15 Bionic yang secepat kilat. Lompatan besar dalam daya tahan baterai.',
                    'price' => 11999000,
                    'promo_price' => 10999000,
                    'stock' => 25,
                    'is_new' => false,
                    'image_url' => 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'iphone_13.jpg'
                ]
            ],
            'Aksesoris' => [
                [
                    'name' => 'AirPods Pro (Gen 2) USB-C',
                    'description' => 'AirPods Pro dilengkapi Peredam Kebisingan Aktif yang hingga 2x lebih hebat, Transparansi Adaptif, dan Audio Spasial Personal dengan pelacakan kepala dinamis.',
                    'price' => 3999000,
                    'promo_price' => 3799000,
                    'stock' => 50,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1588449668365-d15e397f6787?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'airpods_pro_2.jpg'
                ],
                [
                    'name' => 'MagSafe Charger Official',
                    'description' => 'Pengisi daya nirkabel MagSafe membuat pengisian daya nirkabel menjadi sangat cepat. Magnet yang sejajar sempurna terpasang pada iPhone Anda.',
                    'price' => 899000,
                    'promo_price' => null,
                    'stock' => 100,
                    'is_new' => false,
                    'image_url' => 'https://images.unsplash.com/photo-1622445262465-2481c4574875?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'magsafe_charger.jpg'
                ],
                [
                    'name' => 'iPhone Silicone Case MagSafe',
                    'description' => 'Silicone Case dengan MagSafe dirancang oleh Apple untuk melengkapi iPhone Anda. Lapisan luar silikon yang halus terasa nyaman di tangan.',
                    'price' => 999000,
                    'promo_price' => 849000,
                    'stock' => 45,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'iphone_silicone_case.jpg'
                ]
            ]
        ];

        // Ensure directories and download files
        \Illuminate\Support\Facades\Storage::disk('public')->deleteDirectory('products');
        \Illuminate\Support\Facades\Storage::disk('public')->makeDirectory('products');

        $downloadImage = function($url, $filename) {
            try {
                $options = [
                    'http' => [
                        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3\r\n"
                    ]
                ];
                $context = stream_context_create($options);
                $contents = @file_get_contents($url, false, $context);
                if ($contents) {
                    \Illuminate\Support\Facades\Storage::disk('public')->put('products/' . $filename, $contents);
                    return 'products/' . $filename;
                }
            } catch (\Exception $e) {
                // Fail silently
            }
            return null;
        };

        foreach ($categoriesData as $categoryName => $products) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName)
            ]);

            foreach ($products as $prod) {
                $this->command->info("Mengunduh gambar untuk: " . $prod['name']);
                $imagePath = $downloadImage($prod['image_url'], $prod['image_name']);

                Product::create([
                    'category_id' => $category->id,
                    'name' => $prod['name'],
                    'slug' => Str::slug($prod['name']),
                    'description' => $prod['description'],
                    'price' => $prod['price'],
                    'promo_price' => $prod['promo_price'],
                    'stock' => $prod['stock'],
                    'image' => $imagePath,
                    'is_new' => $prod['is_new']
                ]);
            }
        }
    }
}
