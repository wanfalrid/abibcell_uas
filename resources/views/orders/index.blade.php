@extends('layouts.app')

@section('title', 'Pesanan Saya - AbibCell')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Pesanan Saya</h1>

    @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <div class="flex items-center space-x-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $order->order_number }}</h3>
                                    <p class="text-sm text-gray-600">{{ $order->created_at->format('d M Y H:i') }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $order->status_badge }}">
                                    {{ $order->status_text }}
                                </span>
                            </div>
                            
                            <div class="mt-2 text-sm text-gray-600">
                                <p>{{ $order->items->count() }} item • Total: Rp {{ number_format($order->total) }}</p>
                                <p>Alamat: {{ $order->shipping_address }}, {{ $order->shipping_city }}</p>
                            </div>
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('orders.show', $order->id) }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition duration-300">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-shopping-bag text-6xl text-gray-400 mb-6"></i>
            <h2 class="text-2xl font-semibold text-gray-900 mb-4">Belum Ada Pesanan</h2>
            <p class="text-gray-600 mb-8">Anda belum memiliki pesanan. Mulai belanja sekarang!</p>
            <a href="{{ route('products.index') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                Mulai Belanja
            </a>
        </div>
    @endif
</div>
@endsection 