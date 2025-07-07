@extends('layout')

@section('title', 'Payment')
@section('grid-col', 'col-span-6') 
@section('show-cart', 'hidden') 

@section('content')
    <div class="flex flex-1 flex-col items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-6">
        <!-- Payment Card Container - Horizontal Layout -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-6xl w-full mx-auto transform hover:scale-105 transition-transform duration-300">
            
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Payment</h2>
                <p class="text-gray-600 text-lg">สแกน QR Code เพื่อชำระเงิน</p>
            </div>

            <!-- Horizontal Content Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                
                <!-- Left Side - QR Code Section -->
                <div class="flex flex-col items-center space-y-6">
                    <!-- Payment Amount Display -->
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl p-6 w-full max-w-sm text-center">
                        <p class="text-white text-sm font-medium mb-1">ยอดที่ต้องชำระ</p>
                        <p class="text-white text-4xl font-bold">฿{{ number_format($totalPrice, 2) }}</p>
                    </div>

                    <!-- QR Code -->
                    <div class="text-center">
                        <div class="inline-block p-6 bg-white rounded-2xl shadow-lg border-4 border-gray-100">
                            <img src="https://www.pp-qr.com/api/image/0946530776/{{$totalPrice}}" 
                                 alt="QR Code for Payment" 
                                 class="w-56 h-56 mx-auto rounded-lg" />
                        </div>
                        <p class="text-sm text-gray-500 mt-4">
                            <span class="inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                ใช้แอปธนาคารสแกน QR Code
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Right Side - Instructions and Actions -->
                <div class="flex flex-col justify-center space-y-6">
                    
                    <!-- Payment Instructions -->
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-amber-500 mt-1 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="text-lg font-semibold text-amber-800 mb-3">วิธีการชำระเงิน</p>
                                <div class="space-y-3 text-amber-700">
                                    <div class="flex items-center">
                                        <span class="bg-amber-200 text-amber-800 rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold mr-3 flex-shrink-0">1</span>
                                        <span>เปิดแอปธนาคารของคุณ</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="bg-amber-200 text-amber-800 rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold mr-3 flex-shrink-0">2</span>
                                        <span>เลือกสแกน QR Code</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="bg-amber-200 text-amber-800 rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold mr-3 flex-shrink-0">3</span>
                                        <span>ตรวจสอบยอดเงินและยืนยันการชำระ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <form action="{{route('createOrder')}}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" value="{{ $user->id ?? 0 }}" name="member-id">

                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-green-300 text-lg">
                                <span class="inline-flex items-center justify-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    ชำระเงินเสร็จสิ้น
                                </span>
                            </button>
                        </form>
                        
                        <button onclick="history.back()" 
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-8 rounded-xl transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300 text-lg">
                            <span class="inline-flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                กลับไปแก้ไข
                            </span>
                        </button>
                    </div>

                    
                </div>
            </div>
        </div>

        <!-- Loading Animation (Hidden by default) -->
        <div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto mb-4"></div>
                <p class="text-gray-600">กำลังดำเนินการ...</p>
            </div>
        </div>
    </div>

    <script>
   
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('loading').classList.remove('hidden');
        });

 
        document.addEventListener('DOMContentLoaded', function() {
            
            const card = document.querySelector('.bg-white.rounded-3xl');
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
@endsection