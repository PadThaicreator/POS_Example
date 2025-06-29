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
                    if (selected === 'All' || card.getAttribute('data-category') === selected) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

@section('grid-col' ,'col-span-6') 
@section('show-cart' ,'hidden') 

@section('title', 'Order')
@section('content')
    <div class="flex flex-1 flex-col gap-2">
        <h1>edit Page</h1>
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
                <div class="menu-card flex flex-col gap-2 bg-white p-4 rounded-lg shadow-md" data-category="{{ $item->category }}">
                    <div class="w-full h-32 overflow-hidden">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h2 class="font-bold text-xl">{{ $item->name }}</h2>
                        <p class="text-gray-600">{{ $item->price }} ฿</p>
                    </div>
                    <button class="mt-2">
                        <a href="/menu/edit/{{$item->id}}" class="bg-blue-500 text-white p-2 px-5 rounded-lg hover:bg-blue-700">Edit</a>
                    </button>
                </div>
            @endforeach 
        </div>
    </div>
@endsection