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
            'Elektronik' => [
                [
                    'name' => 'Smartphone Flagship X1',
                    'description' => 'Smartphone premium dengan layar AMOLED 120Hz, kamera utama 108MP, dan baterai tahan lama untuk menunjang produktivitas harianmu.',
                    'price' => 8999000,
                    'promo_price' => 7999000,
                    'stock' => 15,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'smartphone_flagship.jpg'
                ],
                [
                    'name' => 'Wireless Headphone ANC',
                    'description' => 'Nikmati kualitas audio premium tanpa gangguan dengan teknologi Active Noise Cancelling terkini. Baterai tahan hingga 30 jam pemakaian.',
                    'price' => 1899000,
                    'promo_price' => 1499000,
                    'stock' => 25,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'wireless_headphone.jpg'
                ],
                [
                    'name' => 'Mechanical Keyboard RGB TKL',
                    'description' => 'Keyboard mekanik dengan switch tactile yang nyaman digunakan untuk mengetik tugas maupun bermain game. Dilengkapi dengan backlit RGB kustom.',
                    'price' => 749000,
                    'promo_price' => null,
                    'stock' => 30,
                    'is_new' => false,
                    'image_url' => 'https://images.unsplash.com/photo-1618384887929-16ec33fab9ef?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'mechanical_keyboard.jpg'
                ]
            ],
            'Pakaian' => [
                [
                    'name' => 'Kaos Polos Cotton Combed 30s',
                    'description' => 'Kaos polos kasual terbuat dari 100% serat katun combed 30s yang sangat lembut, adem, dan menyerap keringat. Cocok untuk bersantai sehari-hari.',
                    'price' => 85000,
                    'promo_price' => 59000,
                    'stock' => 50,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'cotton_tshirt.jpg'
                ],
                [
                    'name' => 'Jaket Bomber Classic Premium',
                    'description' => 'Jaket bomber dengan desain modern klasik dan material anti air yang kokoh. Nyaman dipakai saat berkendara maupun hang out malam hari.',
                    'price' => 299000,
                    'promo_price' => 249000,
                    'stock' => 12,
                    'is_new' => false,
                    'image_url' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'bomber_jacket.jpg'
                ],
                [
                    'name' => 'Celana Chino Slim Fit Casual',
                    'description' => 'Celana panjang chino dengan potongan slim fit terbuat dari bahan katun twill stretch premium yang elastis dan modis untuk dipakai formal maupun kasual.',
                    'price' => 199000,
                    'promo_price' => null,
                    'stock' => 20,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'chino_pants.jpg'
                ]
            ],
            'Alat Tulis' => [
                [
                    'name' => 'Buku Catatan Notebook A5 Hardcover',
                    'description' => 'Buku catatan bersampul tebal (hardcover) bermotif elegan dengan kertas premium berwarna krem yang nyaman untuk mata saat menulis jurnal atau catatan sekolah.',
                    'price' => 65000,
                    'promo_price' => 49000,
                    'stock' => 40,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1531346878377-a5be20888e57?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'notebook_hardcover.jpg'
                ],
                [
                    'name' => 'Pulpen Gel 0.5mm Premium Black',
                    'description' => 'Pulpen gel dengan ujung pen 0.5mm yang menghasilkan goresan tinta hitam sangat pekat, cepat kering, dan anti luber. Sangat nyaman digenggam.',
                    'price' => 15000,
                    'promo_price' => null,
                    'stock' => 100,
                    'is_new' => false,
                    'image_url' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'gel_pen_premium.jpg'
                ],
                [
                    'name' => 'Pensil Gambar Set Sketsa Professional',
                    'description' => 'Satu set lengkap pensil sketsa berkualitas tinggi mulai dari grade H, HB, hingga 8B. Dilengkapi kotak timah pelindung untuk kemudahan penyimpanan.',
                    'price' => 125000,
                    'promo_price' => 99000,
                    'stock' => 8,
                    'is_new' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?q=80&w=600&auto=format&fit=crop',
                    'image_name' => 'sketch_pencil_set.jpg'
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
