<?php

function getInCart($item)
{
    session()->push('cart', $item);
    dd(session('cart'));
}

?>




@extends('layout')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const categories = document.querySelectorAll('.category-btn');
        const menuCards = document.querySelectorAll('.menu-card');
        const selectedCategoryInput = document.getElementById('selectedCategory');
        categories.forEach(category => {
            category.addEventListener('click', function() {
                categories.forEach(c => c.classList.remove('bg-blue-500', 'text-white'));
                this.classList.add('bg-blue-500', 'text-white');
                const selected = this.getAttribute('data-value');
                selectedCategoryInput.value = selected;
                menuCards.forEach(card => {
                    if (selected === 'All' || card.getAttribute('data-category') ===
                        selected) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

@section('title', 'Order')


@section('grid-col', 'col-span-5')



@section('content')
    <div class="flex flex-1 flex-col gap-2">
        <h1>Order Page</h1>
        <div class="flex">
            <div class="grid grid-cols-4 gap-2 border p-2 text-center">
                <div class="category-btn bg-blue-500 text-white p-2 rounded cursor-pointer" data-value="All">All</div>
                <div class="category-btn p-2 rounded cursor-pointer" data-value="Food">Food</div>
                <div class="category-btn p-2 rounded cursor-pointer" data-value="Drink">Drink</div>
                <div class="category-btn p-2 rounded cursor-pointer" data-value="Dessert">Dessert</div>
            </div>
            <input type="hidden" id="selectedCategory" value="All">
        </div>
        <div class="grid grid-cols-5 gap-4 mt-4">
            @foreach ($menus as $item)
                <div class="menu-card flex flex-col gap-2 bg-white p-4 rounded-lg shadow-md"
                    data-category="{{ $item->category }}">
                    <div class="w-full h-32 overflow-hidden">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h2 class="font-bold text-xl">{{ $item->name }}</h2>
                        <p class="text-gray-600">{{ $item->price }} ฿</p>
                    </div>

                    <form action="{{ route('addToCart') }}" method="POST">
                        @csrf
                        <div class="flex flex-col items-center">
                            <input type="hidden" name="menu_id" value="{{ $item->id }}">
                            <input type="submit" value="Order"
                                class="bg-blue-500 text-white p-2 px-5 rounded-lg hover:bg-blue-700" />
                        </div>

                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection


@section('cart-content')
    <div class="flex flex-1 flex-col gap-2">
        <div class="self-end text-xl">Cart</div>
        @php
            $cart = session('cart', []);
            function removeItem($index)
            {
                $cart = session('cart', []);
                dd($cart);

                if (isset($cart[$index])) {
                    unset($cart[$index]);
                    session(['cart' => array_values($cart)]);
                }
                return redirect()->back();
            }
            $totalPrice = 0;
            foreach ($cart as $item) {
                $totalPrice += $item->price;
            }

        @endphp

        @if (count($cart) > 0)
            @foreach ($cart as $item)
                <div class="flex p-2 rounded-lg shadow-md gap-2">
                    <div class="w-16 h-16 overflow-hidden rounded-lg ">
                        <img src={{ $item->image }} alt="" class="object-cover w-full h-full">
                    </div>
                    <div class="flex flex-1 flex-col">
                        <div>{{ $item->name }} - {{ $item->price }} ฿</div>

                        <div class="flex justify-between">
                            <div class="flex justify-center items-center "><div>x</div> <div>{{$item->quantity}}</div></div>
                            <a href="/cart/remove/{{ $loop->index }}">
                                <i class="bi bi-trash3-fill text-red-500 p-1  cursor-pointer"></i>
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="text-gray-500"> Cart empty</div>
        @endif

        <div>
            Total Price : {{ $totalPrice }}
        </div>

        <div class="flex flex-col justify-center items-center">
            <form method="GET" action="{{ route('summaryPage') }}">
                @csrf
                <input type="submit" value="Confirm Order"
                    class="bg-blue-500 p-2 px-10 rounded-lg text-white cursor-pointer">
            </form>


            <form method="POST" action="{{ route('clearCart') }}">
                @csrf
                <input type="submit" value="Clear" class="bg-red-500  p-2 px-10 rounded-lg text-white cursor-pointer">
            </form>
        </div>

    </div>
@endsection
