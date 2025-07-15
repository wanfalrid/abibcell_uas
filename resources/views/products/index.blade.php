@extends('layouts.app')

@section('title', 'Produk - AbibCell')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h3 class="text-lg font-semibold mb-4">Filter Produk</h3>
                
                <!-- Category Filter -->
                <div class="mb-6">
                    <h4 class="font-medium mb-3">Kategori</h4>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                            <label class="flex items-center">
                                <input type="checkbox" name="category" value="{{ $category->slug }}" 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                       {{ request('category') == $category->slug ? 'checked' : '' }}>
                                <span class="ml-2 text-sm">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Brand Filter -->
                <div class="mb-6">
                    <h4 class="font-medium mb-3">Brand</h4>
                    <div class="space-y-2">
                        @foreach($brands as $brand)
                            <label class="flex items-center">
                                <input type="checkbox" name="brand" value="{{ $brand }}" 
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                       {{ request('brand') == $brand ? 'checked' : '' }}>
                                <span class="ml-2 text-sm">{{ $brand }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-6">
                    <h4 class="font-medium mb-3">Rentang Harga</h4>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Harga Minimum</label>
                            <input type="number" name="min_price" placeholder="Rp 0" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ request('min_price') }}">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Harga Maksimum</label>
                            <input type="number" name="max_price" placeholder="Rp 10.000.000" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                   value="{{ request('max_price') }}">
                        </div>
                    </div>
                </div>

                <!-- Sort Filter -->
                <div class="mb-6">
                    <h4 class="font-medium mb-3">Urutkan</h4>
                    <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    </select>
                </div>

                <!-- Apply Filters Button -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
                    Terapkan Filter
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="lg:w-3/4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Semua Produk</h1>
                <p class="text-gray-600">{{ $products->total() }} produk ditemukan</p>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                    <p class="text-gray-600">Coba ubah filter pencarian Anda</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle filter form submission
    const filterForm = document.querySelector('form');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const inputs = document.querySelectorAll('input[type="number"], select');
    
    function updateFilters() {
        const formData = new FormData();
        
        // Add checked checkboxes
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                formData.append(checkbox.name, checkbox.value);
            }
        });
        
        // Add input values
        inputs.forEach(input => {
            if (input.value) {
                formData.append(input.name, input.value);
            }
        });
        
        // Build query string
        const params = new URLSearchParams(formData);
        window.location.href = '{{ route("products.index") }}?' + params.toString();
    }
    
    // Add event listeners
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateFilters);
    });
    
    inputs.forEach(input => {
        input.addEventListener('change', updateFilters);
    });
});
</script>
@endsection 