@extends('layout')

<?php $categories = ['Food', 'Drink', 'Dessert']; ?>

@section('title', 'Add Menu')
@section('grid-col' ,'col-span-6') 
@section('show-cart' ,'hidden') 

@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imageInput = document.getElementById('image');
            const preview = document.getElementById('preview');

            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.classList.add('hidden');
                }
            });
        });
    </script>

    <div class="flex flex-1 items-center flex-col">
        <h1 class="text-2xl font-semibold mb-10">Add Menu</h1>

        <form action="{{route('addMenu')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-4 items-center justify-center">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="name">Menu Name</label>
                        <input type="text" id="name" name="name"class="border border-black p-2 rounded-lg w-full mt-2" placeholder="Enter Menu Name">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="description">Menu Description</label>
                        <textarea id="description" name="description" class="border border-black p-2 rounded-lg w-full mt-2 resize-none"placeholder="Enter Menu Description" rows="4"></textarea>
                        @error('description')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="price">Menu Price</label>
                        <input type="number" id="price" name="price"class="border border-black p-2 rounded-lg w-full mt-2" placeholder="Enter Menu Price">
                        @error('price')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="category">Menu Category</label>
                        <select id="category" name="category" class="border border-black p-2 rounded-lg w-full mt-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="image">Menu Image</label>
                        <input type="file" id="image" name="image"
                            class="border border-black p-2 rounded-lg w-full mt-2">
                    </div>
                    <div>
                        <img id="preview" src="" alt="Image Preview"
                            class="w-full h-48 object-cover rounded-lg mt-2 hidden">
                    </div>
                </div>
                <input type="hidden"  id="mode" name="mode" value="add">
                <input type="submit" value="Save"class="border border-blue-600 bg-blue-400 p-2 px-10 rounded-lg mt-4 hover:bg-blue-700 cursor-pointer text-white">
            </div>
        </form>
    </div>
@endsection
