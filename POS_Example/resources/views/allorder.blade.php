@extends('layout')

@section('title', 'Order')
@section('grid-col', 'col-span-6')
@section('show-cart', 'hidden')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">All Orders</h1>
    
    @if($orders->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($orders as $item)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-t-lg">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Order #{{ $item->id }}</h3>
                            <span class="bg-white bg-opacity-20 px-2 py-1 rounded-full text-sm">
                                {{ \Carbon\Carbon::parse($item->createdAt)->format('M d, Y') }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="p-4">
                        <div class="space-y-3">
                            <!-- Customer Info -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">Customer ID</p>
                                    <p class="font-medium text-gray-800">{{ $item->customer->firstName }} {{ $item->customer->lastName }}</p>
                                </div>
                            </div>
                            
                            <!-- Staff Info -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0012 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">Staff ID</p>
                                    <p class="font-medium text-gray-800">{{ $item->staff->firstName }} {{ $item->staff->lastName }}</p>
                                </div>
                            </div>
                            
                            <!-- Total Price -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">Total Price</p>
                                    <p class="font-bold text-green-600 text-lg">฿{{ number_format($item->totalPrice, 2) }}</p>
                                </div>
                            </div>
                            
                            <!-- Created Date -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v14a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-600">Order Date</p>
                                    <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($item->createdAt)->format('F j, Y') }}</p>
                                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->createdAt)->format('g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="bg-gray-50 px-4 py-3 rounded-b-lg border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <a href="{{route('detailOrderPage' , $item->id)}}" class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-200">
                                View Details
                            </a>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="max-w-md mx-auto">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Orders Found</h3>
                <p class="text-gray-600">There are no orders to display at this time.</p>
            </div>
        </div>
    @endif
</div>
@endsection