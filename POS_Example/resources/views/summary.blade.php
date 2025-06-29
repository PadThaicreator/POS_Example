@extends('layout')



@section('title', 'Order')
@section('grid-col', 'col-span-6')
@section('show-cart', 'hidden')
@php
    $cart = session('cart', []);
@endphp

@section('content')
    <div class="flex flex-1 flex-col gap-4">
        <div class="text-2xl font-semibold">Summary Order</div>
        <div class="grid grid-cols-4 gap-4">
            @foreach ($cart as $item)
                <div class="flex flex-1 border rounded-lg shadow-lg p-4 gap-2">
                    <div class="flex overflow-hidden w-24 h-24"><img src="{{ $item->image }}" alt="{{ $item->image }}"
                            class="w-full h-full object-cover"></div>
                    <div class="flex flex-1 border flex-col">
                        <div>Menu : {{ $item->name }}</div>
                        <div>Price : {{ $item->price }} ฿</div>
                        <div class="flex justify-between">
                            <div class="flex justify-center items-center ">
                                <div>x</div>
                                <div>{{ $item->quantity }}</div>
                            </div>
                            <a href="/cart/remove/{{ $loop->index }}">
                                <i class="bi bi-trash3-fill text-red-500 p-1  cursor-pointer"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex flex-col border rounded-lg shadow-lg p-4">
            <div><input type="checkbox" name="isMember" class="mr-3"> Member</div>
            <div id='member-fill' class="hidden flex flex-col  gap-2 ">
                <div class="flex items-center gap-2">
                    <input type="text" id="memberPhone" class="p-2 border-gray-400 border rounded-lg ">
                    <button onclick="handleMember()" id="tik"
                        class="bg-green-500 rounded-full text-white p-1 w-6 h-6 flex items-center justify-center "><i
                            class="bi bi-check"></i>
                    </button>
                    <button onclick="handleInput()" id="tik"
                        class="bg-red-500 rounded-full text-white p-1 w-6 h-6 flex items-center justify-center "><i
                            class="bi bi-x"></i>
                    </button>
                </div>
                <div class="flex ">
                    <p id="member-show" class="p-2 px-3 border rounded-2xl hidden">Member : </p>
                </div>
            </div>
        </div>
        <div class="flex  self-end border">
            <form action="{{ route('paymentPage') }}" method="GET">
                @csrf
                <input type="hidden" id="member-id"  name="member-id">
                <input type="submit" value="Confirm Order and Go To Payment Page"
                    class="bg-blue-500  p-2 px-10 rounded-lg text-white cursor-pointer">
            </form>
        </div>
    </div>

    <script>
        const isMember = document.getElementsByName('isMember')[0];

        isMember.addEventListener('change', () => {
            if (isMember.checked) {
                document.getElementById('member-fill').classList.remove('hidden');
            } else {
                document.getElementById('member-fill').classList.add('hidden');
                document.getElementById('member-id').value = "";
            }
        });


        function handleMember() {
           
            const phone = document.getElementById('memberPhone').value;
            const users = @json($user);

            const mem = users.find((item) => item.phoneNumber === phone);
            

            if (mem) {
                
                document.getElementById('memberPhone').disabled = true;
                document.getElementById('tik').disabled = true;
                document.getElementById('member-show').classList.remove('hidden');
                document.getElementById('member-show').textContent =mem.firstName + "  " + mem.lastName;
                document.getElementById('member-id').value=mem.id;
            } else {
                
                document.getElementById('member-show').classList.remove('hidden');
                document.getElementById('member-show').textContent = "Not Found Member" ;
            }

        }

        function handleInput() {
            document.getElementById('memberPhone').disabled = false;
            document.getElementById('tik').disabled = false;
        }
    </script>
@endsection
