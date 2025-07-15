@extends('layouts.app')

@section('title', 'AbibCell - Toko Handphone Terpercaya')

@section('content')
    <!-- Hero Section -->
    <section class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Temukan Handphone Impian Anda
                </h1>
                <p class="text-xl mb-8 text-blue-100">
                    Berbagai pilihan smartphone terbaru dengan harga terbaik dan kualitas terjamin
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Lihat Produk
                    </a>
                    <a href="#featured" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                        Produk Unggulan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Kategori Produk</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('category', $category->slug) }}" class="group">
                        <div class="bg-gray-100 rounded-lg p-6 text-center hover:bg-blue-50 transition duration-300">
                            <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700">
                                <i class="fas fa-mobile-alt text-white text-2xl"></i>
                            </div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-blue-600">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-600 mt-2">{{ $category->products_count ?? 0 }} Produk</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Produk Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-md product-card">
                        <div class="relative">
                            <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                            @if($product->discount_percentage > 0)
                                <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                    -{{ $product->discount_percentage }}%
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $product->brand }} {{ $product->model }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($product->sale_price)
                                        <span class="text-lg font-bold text-red-600">Rp {{ number_format($product->sale_price) }}</span>
                                        <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($product->price) }}</span>
                                    @else
                                        <span class="text-lg font-bold text-gray-900">Rp {{ number_format($product->price) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition duration-300">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Products -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Produk Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestProducts as $product)
                    <div class="bg-white rounded-lg shadow-md product-card">
                        <div class="relative">
                            <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                            @if($product->discount_percentage > 0)
                                <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                    -{{ $product->discount_percentage }}%
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $product->brand }} {{ $product->model }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($product->sale_price)
                                        <span class="text-lg font-bold text-red-600">Rp {{ number_format($product->sale_price) }}</span>
                                        <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($product->price) }}</span>
                                    @else
                                        <span class="text-lg font-bold text-gray-900">Rp {{ number_format($product->price) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition duration-300">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih AbibCell?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shipping-fast text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600">Pengiriman ke seluruh Indonesia dengan layanan ekspres</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Garansi Resmi</h3>
                    <p class="text-gray-600">Semua produk bergaransi resmi dengan service center</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Layanan 24/7</h3>
                    <p class="text-gray-600">Customer service siap membantu Anda kapan saja</p>
                </div>
            </div>
        </div>
    </section>
@endsection 