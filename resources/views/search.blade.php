@extends('layouts.app')

@section('title', 'Hasil Pencarian - AbibCell')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Search Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Hasil Pencarian</h1>
        <p class="text-gray-600">Menampilkan hasil pencarian untuk: <strong>"{{ $query }}"</strong></p>
    </div>

    <!-- Search Results -->
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md product-card">
                    <div class="relative">
                        <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-t-lg">
                        @if($product->discount_percentage > 0)
                            <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                -{{ $product->discount_percentage }}%
                            </div>
                        @endif
                        @if($product->is_featured)
                            <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>Unggulan
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ $product->brand }} {{ $product->model }}</p>
                        
                        <!-- Product Specs -->
                        <div class="text-xs text-gray-500 mb-3">
                            @if($product->storage)
                                <span class="inline-block bg-gray-100 px-2 py-1 rounded mr-1">{{ $product->storage }}</span>
                            @endif
                            @if($product->ram)
                                <span class="inline-block bg-gray-100 px-2 py-1 rounded mr-1">{{ $product->ram }}</span>
                            @endif
                            @if($product->color)
                                <span class="inline-block bg-gray-100 px-2 py-1 rounded">{{ $product->color }}</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            <div>
                                @if($product->sale_price)
                                    <span class="text-lg font-bold text-red-600">Rp {{ number_format($product->sale_price) }}</span>
                                    <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($product->price) }}</span>
                                @else
                                    <span class="text-lg font-bold text-gray-900">Rp {{ number_format($product->price) }}</span>
                                @endif
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('products.show', $product->slug) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700 transition duration-300">
                                    Detail
                                </a>
                                @auth
                                    <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition duration-300">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
            <p class="text-gray-600 mb-4">Coba ubah kata kunci pencarian Anda</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Lihat Semua Produk
            </a>
        </div>
    @endif
</div>
@endsection 