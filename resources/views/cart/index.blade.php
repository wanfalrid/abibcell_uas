@extends('layouts.app')

@section('title', 'Keranjang Belanja - AbibCell')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-semibold">Produk ({{ $cartItems->count() }} item)</h2>
                    </div>
                    
                    <div class="divide-y">
                        @foreach($cartItems as $cartItem)
                            <div class="p-6 flex items-center space-x-4">
                                <img src="{{ $cartItem->product->thumbnail_url }}" alt="{{ $cartItem->product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                                
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $cartItem->product->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $cartItem->product->brand }} {{ $cartItem->product->model }}</p>
                                    
                                    @if($cartItem->product->storage)
                                        <span class="inline-block bg-gray-100 px-2 py-1 rounded text-xs mr-2">{{ $cartItem->product->storage }}</span>
                                    @endif
                                    @if($cartItem->product->color)
                                        <span class="inline-block bg-gray-100 px-2 py-1 rounded text-xs">{{ $cartItem->product->color }}</span>
                                    @endif
                                </div>

                                <div class="text-right">
                                    <div class="mb-2">
                                        @if($cartItem->product->sale_price)
                                            <span class="text-lg font-bold text-red-600">Rp {{ number_format($cartItem->product->sale_price) }}</span>
                                            <span class="text-sm text-gray-500 line-through ml-2">Rp {{ number_format($cartItem->product->price) }}</span>
                                        @else
                                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($cartItem->product->price) }}</span>
                                        @endif
                                    </div>

                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            @method('PUT')
                                            <label class="text-sm text-gray-600">Qty:</label>
                                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" max="{{ $cartItem->product->stock }}" 
                                                   class="w-16 px-2 py-1 border border-gray-300 rounded text-sm">
                                            <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="mt-2">
                                        <span class="font-semibold text-gray-900">Rp {{ number_format($cartItem->subtotal) }}</span>
                                    </div>
                                </div>

                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-6 border-t">
                        <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                <i class="fas fa-trash mr-1"></i>
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                            <span class="font-semibold">Rp {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="font-semibold">Rp 10.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">PPN (11%)</span>
                            <span class="font-semibold">Rp {{ number_format($total * 0.11) }}</span>
                        </div>
                        <hr class="my-3">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span>Rp {{ number_format($total + 10000 + ($total * 0.11)) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 text-center block">
                        Lanjut ke Pembayaran
                    </a>

                    <div class="mt-4 text-center">
                        <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-arrow-left mr-1"></i>
                            Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-cart text-6xl text-gray-400 mb-6"></i>
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Keranjang Belanja Kosong</h2>
            <p class="text-gray-600 mb-8">Anda belum menambahkan produk ke keranjang belanja.</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection 