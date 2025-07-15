@extends('layouts.app')

@section('title', 'Detail Pesanan - AbibCell')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-blue-600">Pesanan Saya</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-500">Detail Pesanan</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Informasi Pesanan</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">Detail Pesanan</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nomor Pesanan:</span>
                                <span class="font-medium">{{ $order->order_number }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Pesanan:</span>
                                <span class="font-medium">{{ $order->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status:</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $order->status_badge }}">
                                    {{ $order->status_text }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Metode Pembayaran:</span>
                                <span class="font-medium">{{ ucfirst($order->payment_method) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">Alamat Pengiriman</h3>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>{{ $order->shipping_address }}</p>
                            <p>{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                            <p>Tel: {{ $order->shipping_phone }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Item Pesanan</h2>
                
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center space-x-4 p-4 border rounded-lg">
                            <img src="{{ $item->product->thumbnail_url }}" alt="{{ $item->product_name }}" 
                                 class="w-16 h-16 object-cover rounded">
                            
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-900">{{ $item->product_name }}</h3>
                                <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                            </div>
                            
                            <div class="text-right">
                                <p class="font-semibold text-gray-900">Rp {{ number_format($item->price) }}</p>
                                <p class="text-sm text-gray-600">Subtotal: Rp {{ number_format($item->subtotal) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                <h2 class="text-xl font-semibold mb-4">Ringkasan Pembayaran</h2>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Ongkos Kirim</span>
                        <span>Rp {{ number_format($order->shipping_cost) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">PPN (11%)</span>
                        <span>Rp {{ number_format($order->tax) }}</span>
                    </div>
                    <hr class="my-3">
                    <div class="flex justify-between font-semibold text-lg">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total) }}</span>
                    </div>
                </div>

                @if($order->status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                        <h3 class="font-semibold text-yellow-800 mb-2">Menunggu Pembayaran</h3>
                        <p class="text-sm text-yellow-700">
                            Silakan lakukan pembayaran ke rekening yang telah kami berikan. 
                            Pesanan akan diproses setelah pembayaran dikonfirmasi.
                        </p>
                    </div>
                @endif

                @if($order->notes)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Catatan</h3>
                        <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 