@extends('layout')



@section('title', 'Order Detail')
@section('grid-col', 'col-span-6')
@section('show-cart', 'hidden')

@section('content')
    <div class="flex flex-1 flex-col">
        <div>
            <div class="flex justify-between rounded-t-lg bg-blue-500 p-4 text-white">
                <div class="text-xl font-semibold">OrderId #{{ $order->id }}</div>
                <div>Buy At {{ \Carbon\Carbon::parse($order->createdAt)->format('d M Y H:i:s') }}</div>
            </div>
            <div class="flex flex-col p-4 rounded-b-lg shadow-lg border bg-gray-100 gap-4">
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0">
                        <!-- ข้อมูลลูกค้าและพนักงาน -->
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500 font-medium">Member:</span>
                                    <span class="text-gray-800 font-semibold ml-2">{{ $order->customer->firstName }}
                                        {{ $order->customer->lastName }}</span>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500 font-medium">Staff:</span>
                                    <span class="text-gray-800 font-semibold ml-2">{{ $order->staff->firstName }}
                                        {{ $order->staff->lastName }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- ราคารวม -->
                        <div class="md:text-right">
                            <div class="text-sm text-gray-500 font-medium mb-1">Total Price</div>
                            <div class="text-3xl font-bold text-green-600">
                                ฿{{ number_format($order->totalPrice, 0) }}
                            </div>
                            
                        </div>
                    </div>


                </div>
                <div class="flex flex-col  bg-white rounded-lg shadow-lg p-4">
                    <div>Order Detail</div>
                    @foreach ($orderDetail as $item)
                        <div
                            class="flex items-center bg-white rounded-lg shadow-md border border-gray-200 mb-3 p-4 hover:shadow-lg transition-shadow duration-200">
                            <!-- รูปภาพ -->
                            <div class="flex-shrink-0 mr-4 ">
                                <img src="{{ $item->menus->image }}" alt="{{ $item->menus->name }}"
                                    class="w-16 h-16 rounded-lg object-cover border border-gray-100">
                            </div>

                            <!-- ข้อมูลเมนู -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-800 truncate mb-1">
                                    {{ $item->menus->name }}
                                </h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-green-600">
                                        ฿{{ number_format($item->price, 0) }}
                                    </span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-500">Amount :</span>
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                                            {{ $item->amount }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
