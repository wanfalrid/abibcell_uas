@extends('layouts.app')

@section('title', $product->name . ' - AbibCell')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <!-- Product Images -->
            <div>
                <div class="relative">
                    <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded-lg">
                    @if($product->discount_percentage > 0)
                        <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            -{{ $product->discount_percentage }}%
                        </div>
                    @endif
                    @if($product->is_featured)
                        <div class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-star mr-1"></i>Unggulan
                        </div>
                    @endif
                </div>
                
                @if($product->images && count($product->images) > 0)
                    <div class="grid grid-cols-4 gap-2 mt-4">
                        @foreach($product->images_urls as $image)
                            <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-20 object-cover rounded cursor-pointer hover:opacity-75 transition duration-300">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <a href="{{ route('category', $product->category->slug) }}" class="text-gray-700 hover:text-blue-600">{{ $product->category->name }}</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-gray-500">{{ $product->name }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>

                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $product->brand }} {{ $product->model }}</p>

                <!-- Price -->
                <div class="mb-6">
                    @if($product->sale_price)
                        <div class="flex items-center space-x-3">
                            <span class="text-3xl font-bold text-red-600">Rp {{ number_format($product->sale_price) }}</span>
                            <span class="text-xl text-gray-500 line-through">Rp {{ number_format($product->price) }}</span>
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm font-semibold">
                                Hemat Rp {{ number_format($product->price - $product->sale_price) }}
                            </span>
                        </div>
                    @else
                        <span class="text-3xl font-bold text-gray-900">Rp {{ number_format($product->price) }}</span>
                    @endif
                </div>

                <!-- Stock Status -->
                <div class="mb-6">
                    @if($product->stock > 0)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-2"></i>
                            Stok Tersedia ({{ $product->stock }} unit)
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-2"></i>
                            Stok Habis
                        </span>
                    @endif
                </div>

                <!-- Add to Cart -->
                @auth
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST" class="mb-6">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="flex items-center space-x-4 mb-4">
                                <label class="text-sm font-medium text-gray-700">Jumlah:</label>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                       class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 mb-3">
                                <i class="fas fa-cart-plus mr-2"></i>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full bg-gray-400 text-white py-3 px-6 rounded-lg font-semibold cursor-not-allowed mb-3">
                            Stok Habis
                        </button>
                    @endif
                @else
                    <div class="mb-6">
                        <a href="{{ route('login') }}" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 inline-block text-center">
                            Login untuk Membeli
                        </a>
                    </div>
                @endauth

                <!-- Product Specs -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Spesifikasi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($product->brand)
                            <div>
                                <span class="text-sm text-gray-600">Brand:</span>
                                <p class="font-medium">{{ $product->brand }}</p>
                            </div>
                        @endif
                        @if($product->model)
                            <div>
                                <span class="text-sm text-gray-600">Model:</span>
                                <p class="font-medium">{{ $product->model }}</p>
                            </div>
                        @endif
                        @if($product->color)
                            <div>
                                <span class="text-sm text-gray-600">Warna:</span>
                                <p class="font-medium">{{ $product->color }}</p>
                            </div>
                        @endif
                        @if($product->storage)
                            <div>
                                <span class="text-sm text-gray-600">Storage:</span>
                                <p class="font-medium">{{ $product->storage }}</p>
                            </div>
                        @endif
                        @if($product->ram)
                            <div>
                                <span class="text-sm text-gray-600">RAM:</span>
                                <p class="font-medium">{{ $product->ram }}</p>
                            </div>
                        @endif
                        @if($product->screen_size)
                            <div>
                                <span class="text-sm text-gray-600">Layar:</span>
                                <p class="font-medium">{{ $product->screen_size }}</p>
                            </div>
                        @endif
                        @if($product->camera)
                            <div>
                                <span class="text-sm text-gray-600">Kamera:</span>
                                <p class="font-medium">{{ $product->camera }}</p>
                            </div>
                        @endif
                        @if($product->battery)
                            <div>
                                <span class="text-sm text-gray-600">Baterai:</span>
                                <p class="font-medium">{{ $product->battery }}</p>
                            </div>
                        @endif
                        @if($product->processor)
                            <div>
                                <span class="text-sm text-gray-600">Processor:</span>
                                <p class="font-medium">{{ $product->processor }}</p>
                            </div>
                        @endif
                        @if($product->os)
                            <div>
                                <span class="text-sm text-gray-600">OS:</span>
                                <p class="font-medium">{{ $product->os }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="border-t p-8">
            <h3 class="text-lg font-semibold mb-4">Deskripsi Produk</h3>
            <div class="prose max-w-none">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow-md product-card">
                        <div class="relative">
                            <img src="{{ $relatedProduct->thumbnail_url }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover rounded-t-lg">
                            @if($relatedProduct->discount_percentage > 0)
                                <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                    -{{ $relatedProduct->discount_percentage }}%
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $relatedProduct->name }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $relatedProduct->brand }} {{ $relatedProduct->model }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($relatedProduct->sale_price)
                                        <span class="text-lg font-bold text-red-600">Rp {{ number_format($relatedProduct->sale_price) }}</span>
                                        <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($relatedProduct->price) }}</span>
                                    @else
                                        <span class="text-lg font-bold text-gray-900">Rp {{ number_format($relatedProduct->price) }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('products.show', $relatedProduct->slug) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-300">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection 