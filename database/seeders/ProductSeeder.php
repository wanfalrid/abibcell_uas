<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $products = [
            [
                'name' => 'iPhone 15 Pro Max',
                'slug' => 'iphone-15-pro-max',
                'description' => 'iPhone 15 Pro Max dengan chip A17 Pro, kamera 48MP, dan layar Super Retina XDR 6.7 inch. Dilengkapi dengan titanium grade 5 yang ringan dan tahan lama.',
                'specifications' => 'Chip A17 Pro, Kamera 48MP, Layar 6.7 inch, Titanium Design',
                'price' => 25000000,
                'sale_price' => 23000000,
                'stock' => 15,
                'brand' => 'Apple',
                'model' => 'iPhone 15 Pro Max',
                'color' => 'Natural Titanium',
                'storage' => '256GB',
                'ram' => '8GB',
                'screen_size' => '6.7 inch',
                'camera' => '48MP + 12MP + 12MP',
                'battery' => '4441mAh',
                'processor' => 'A17 Pro',
                'os' => 'iOS 17',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'iphone')->first()->id
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'slug' => 'samsung-galaxy-s24-ultra',
                'description' => 'Samsung Galaxy S24 Ultra dengan S Pen, kamera 200MP, dan chip Snapdragon 8 Gen 3. Dilengkapi dengan AI Galaxy yang canggih.',
                'specifications' => 'Snapdragon 8 Gen 3, Kamera 200MP, S Pen, AI Galaxy',
                'price' => 22000000,
                'sale_price' => 20000000,
                'stock' => 20,
                'brand' => 'Samsung',
                'model' => 'Galaxy S24 Ultra',
                'color' => 'Titanium Gray',
                'storage' => '512GB',
                'ram' => '12GB',
                'screen_size' => '6.8 inch',
                'camera' => '200MP + 12MP + 50MP + 10MP',
                'battery' => '5000mAh',
                'processor' => 'Snapdragon 8 Gen 3',
                'os' => 'Android 14',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'smartphone-android')->first()->id
            ],
            [
                'name' => 'Xiaomi 14 Pro',
                'slug' => 'xiaomi-14-pro',
                'description' => 'Xiaomi 14 Pro dengan kamera Leica, chip Snapdragon 8 Gen 3, dan layar AMOLED 2K. Performa gaming yang luar biasa.',
                'specifications' => 'Snapdragon 8 Gen 3, Kamera Leica, Layar AMOLED 2K',
                'price' => 15000000,
                'sale_price' => 13500000,
                'stock' => 25,
                'brand' => 'Xiaomi',
                'model' => '14 Pro',
                'color' => 'Black',
                'storage' => '256GB',
                'ram' => '12GB',
                'screen_size' => '6.73 inch',
                'camera' => '50MP + 50MP + 50MP',
                'battery' => '4880mAh',
                'processor' => 'Snapdragon 8 Gen 3',
                'os' => 'Android 14',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'smartphone-gaming')->first()->id
            ],
            [
                'name' => 'OPPO Find X7 Ultra',
                'slug' => 'oppo-find-x7-ultra',
                'description' => 'OPPO Find X7 Ultra dengan kamera Hasselblad, chip Dimensity 9300, dan layar AMOLED 2K. Fotografi profesional dalam genggaman.',
                'specifications' => 'Dimensity 9300, Kamera Hasselblad, Layar AMOLED 2K',
                'price' => 18000000,
                'sale_price' => 16500000,
                'stock' => 18,
                'brand' => 'OPPO',
                'model' => 'Find X7 Ultra',
                'color' => 'Ocean Blue',
                'storage' => '512GB',
                'ram' => '16GB',
                'screen_size' => '6.82 inch',
                'camera' => '50MP + 50MP + 50MP + 64MP',
                'battery' => '5000mAh',
                'processor' => 'Dimensity 9300',
                'os' => 'Android 14',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'smartphone-kamera')->first()->id
            ],
            [
                'name' => 'iPhone 15',
                'slug' => 'iphone-15',
                'description' => 'iPhone 15 dengan chip A16 Bionic, kamera 48MP, dan layar Super Retina XDR 6.1 inch. Desain yang elegan dan performa yang handal.',
                'specifications' => 'Chip A16 Bionic, Kamera 48MP, Layar 6.1 inch',
                'price' => 15000000,
                'sale_price' => 14000000,
                'stock' => 30,
                'brand' => 'Apple',
                'model' => 'iPhone 15',
                'color' => 'Blue',
                'storage' => '128GB',
                'ram' => '6GB',
                'screen_size' => '6.1 inch',
                'camera' => '48MP + 12MP',
                'battery' => '3349mAh',
                'processor' => 'A16 Bionic',
                'os' => 'iOS 17',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'iphone')->first()->id
            ],
            [
                'name' => 'Samsung Galaxy A55',
                'slug' => 'samsung-galaxy-a55',
                'description' => 'Samsung Galaxy A55 dengan chip Exynos 1480, kamera 50MP, dan layar AMOLED 6.6 inch. Harga terjangkau dengan kualitas terjamin.',
                'specifications' => 'Exynos 1480, Kamera 50MP, Layar AMOLED 6.6 inch',
                'price' => 5000000,
                'sale_price' => 4500000,
                'stock' => 40,
                'brand' => 'Samsung',
                'model' => 'Galaxy A55',
                'color' => 'Awesome Black',
                'storage' => '128GB',
                'ram' => '8GB',
                'screen_size' => '6.6 inch',
                'camera' => '50MP + 12MP + 5MP',
                'battery' => '5000mAh',
                'processor' => 'Exynos 1480',
                'os' => 'Android 14',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'smartphone-budget')->first()->id
            ],
            [
                'name' => 'Xiaomi Redmi Note 13 Pro',
                'slug' => 'xiaomi-redmi-note-13-pro',
                'description' => 'Xiaomi Redmi Note 13 Pro dengan chip Dimensity 7200 Ultra, kamera 200MP, dan layar AMOLED 6.67 inch. Performa gaming yang smooth.',
                'specifications' => 'Dimensity 7200 Ultra, Kamera 200MP, Layar AMOLED 6.67 inch',
                'price' => 4000000,
                'sale_price' => 3500000,
                'stock' => 35,
                'brand' => 'Xiaomi',
                'model' => 'Redmi Note 13 Pro',
                'color' => 'Midnight Black',
                'storage' => '256GB',
                'ram' => '12GB',
                'screen_size' => '6.67 inch',
                'camera' => '200MP + 8MP + 2MP',
                'battery' => '5000mAh',
                'processor' => 'Dimensity 7200 Ultra',
                'os' => 'Android 13',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'smartphone-gaming')->first()->id
            ],
            [
                'name' => 'OPPO Reno 11',
                'slug' => 'oppo-reno-11',
                'description' => 'OPPO Reno 11 dengan chip Dimensity 7050, kamera 50MP, dan layar AMOLED 6.7 inch. Desain yang stylish dan kamera yang canggih.',
                'specifications' => 'Dimensity 7050, Kamera 50MP, Layar AMOLED 6.7 inch',
                'price' => 4500000,
                'sale_price' => 4000000,
                'stock' => 28,
                'brand' => 'OPPO',
                'model' => 'Reno 11',
                'color' => 'Wave Green',
                'storage' => '256GB',
                'ram' => '8GB',
                'screen_size' => '6.7 inch',
                'camera' => '50MP + 32MP + 8MP',
                'battery' => '5000mAh',
                'processor' => 'Dimensity 7050',
                'os' => 'Android 14',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'smartphone-kamera')->first()->id
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
