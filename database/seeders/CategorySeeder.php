<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Smartphone Android',
                'slug' => 'smartphone-android',
                'description' => 'Koleksi smartphone Android terbaru dari berbagai brand ternama',
                'sort_order' => 1
            ],
            [
                'name' => 'iPhone',
                'slug' => 'iphone',
                'description' => 'iPhone terbaru dengan teknologi Apple yang canggih',
                'sort_order' => 2
            ],
            [
                'name' => 'Smartphone Gaming',
                'slug' => 'smartphone-gaming',
                'description' => 'Smartphone khusus untuk gaming dengan performa tinggi',
                'sort_order' => 3
            ],
            [
                'name' => 'Smartphone Kamera',
                'slug' => 'smartphone-kamera',
                'description' => 'Smartphone dengan kamera berkualitas tinggi',
                'sort_order' => 4
            ],
            [
                'name' => 'Smartphone Budget',
                'slug' => 'smartphone-budget',
                'description' => 'Smartphone dengan harga terjangkau dan kualitas terjamin',
                'sort_order' => 5
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
