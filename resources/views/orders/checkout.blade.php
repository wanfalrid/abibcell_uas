@extends('layouts.app')

@section('title', 'Checkout - AbibCell')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Checkout Form -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-6">Informasi Pengiriman</h2>
                
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="shipping_name" value="{{ auth()->user()->name }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" name="shipping_phone" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea name="shipping_address" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Masukkan alamat lengkap pengiriman"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                            <input type="text" name="shipping_city" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                            <input type="text" name="shipping_postal_code" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="transfer" checked
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">Transfer Bank</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="cod"
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">Cash on Delivery (COD)</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea name="notes" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Tambahkan catatan untuk pesanan Anda"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        Buat Pesanan
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-semibold mb-6">Ringkasan Pesanan</h2>
                
                <!-- Cart Items -->
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $cartItem)
                        <div class="flex items-center space-x-3">
                            <img src="{{ $cartItem->product->thumbnail_url }}" alt="{{ $cartItem->product->name }}" 
                                 class="w-12 h-12 object-cover rounded">
                            <div class="flex-1">
                                <h3 class="font-medium text-sm">{{ $cartItem->product->name }}</h3>
                                <p class="text-xs text-gray-600">{{ $cartItem->quantity }} x Rp {{ number_format($cartItem->product->final_price) }}</p>
                            </div>
                            <span class="font-semibold text-sm">Rp {{ number_format($cartItem->subtotal) }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Price Breakdown -->
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                        <span>Rp {{ number_format($total) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Ongkos Kirim</span>
                        <span>Rp {{ number_format($shippingCost) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">PPN (11%)</span>
                        <span>Rp {{ number_format($tax) }}</span>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>Rp {{ number_format($grandTotal) }}</span>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold mb-3">Informasi Pembayaran</h3>
                    <div class="text-sm text-gray-600 space-y-2">
                        <p><strong>Transfer Bank:</strong></p>
                        <p>Bank BCA: 1234567890</p>
                        <p>Bank Mandiri: 0987654321</p>
                        <p>Bank BNI: 1122334455</p>
                        <p class="text-xs mt-2">*Pembayaran akan dikonfirmasi dalam 1x24 jam</p>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('cart.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 