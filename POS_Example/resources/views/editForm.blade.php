@extends('layout')

<?php $categories = ['Food', 'Drink', 'Dessert']; ?>

@section('title', 'Edit Menu')
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
        <h1 class="text-2xl font-semibold mb-10">Edit Menu</h1>

        <form action="{{route('addMenu')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-4 items-center justify-center">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <label for="name">Menu Name</label>
                        <input type="text" id="name"
                            name="name"class="border border-black p-2 rounded-lg w-full mt-2"
                            placeholder="Enter Menu Name" value={{ $Menu->name }}>
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="description">Menu Description</label>
                        <textarea id="description" name="description"
                            class="border border-black p-2 rounded-lg w-full mt-2 resize-none"placeholder="Enter Menu Description"
                            rows="4">{{ $Menu->description }}</textarea>
                        @error('description')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="price">Menu Price</label>
                        <input type="number" id="price"
                            name="price"class="border border-black p-2 rounded-lg w-full mt-2"
                            placeholder="Enter Menu Price" value={{ $Menu->price }}>
                        @error('price')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="category">Menu Category</label>
                        <select id="category" name="category" class="border border-black p-2 rounded-lg w-full mt-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" {{ $Menu->category === $category ? 'selected' : '' }}>
                                    {{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="image">Menu Image</label>
                        <input type="file" id="image" name="image"
                            class="border border-black p-2 rounded-lg w-full mt-2">
                    </div>
                    <div>
                        <img id="preview" src="{{ $Menu->image }}" alt="Image Preview"
                            class="w-full h-48 object-cover rounded-lg mt-2 {{ $Menu->image ? '' : 'hidden' }}">

                    </div>
                    <div class="flex flex-col gap-3">
                        <label class="text-sm font-medium ">
                            Menu Status
                           
                        </label>

                        <div class="flex items-center gap-4">
                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="status" value="{{ $Menu->status ?? 'unavailable' }}"id="status-input">

                            <!-- Toggle Switch -->
                            <div class="relative inline-flex items-center">
                                <input type="checkbox" id="status-toggle" class="sr-only"
                                    {{ $Menu->status === 'available' ? 'checked' : '' }} onchange="toggleStatus()">

                                <label for="status-toggle" class="relative flex items-center cursor-pointer">
                                    <!-- Switch Track -->
                                    <div
                                        class="toggle-track w-14 h-7 bg-gray-300 dark:bg-gray-600 rounded-full shadow-inner transition-colors duration-300 ease-in-out {{ $Menu->status === 'available' ? 'bg-green-500' : 'bg-red-500' }}">
                                        <!-- Switch Thumb -->
                                        <div
                                            class="toggle-thumb absolute top-0.5 left-0.5 w-6 h-6 bg-white rounded-full shadow-md transform transition-transform duration-300 ease-in-out {{ $Menu->status === 'available' ? 'translate-x-7' : 'translate-x-0' }}">
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Status Label -->
                            <div class="flex items-center gap-2">
                                <span class="status-indicator text-lg">
                                    {{ $Menu->status === 'available' ? '🟢' : '🔴' }}
                                </span>
                                <span class="status-text font-medium ">
                                    {{ $Menu->status === 'available' ? 'Available' : 'Unavailable' }}
                                </span>
                            </div>
                        </div>


                        
                        
                    </div>

                    <style>
                        /* Custom toggle styles */
                        .toggle-track {
                            position: relative;
                            background: #ef4444;
                            /* red-500 */
                        }

                        .toggle-track.bg-green-500 {
                            background: #22c55e;
                            /* green-500 */
                        }

                        .toggle-thumb {
                            background: white;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        }

                        /* Hover effects */
                        .toggle-track:hover .toggle-thumb {
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
                        }

                        /* Focus styles */
                        input[type="checkbox"]:focus+label .toggle-track {
                            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
                        }

                        /* Animation for status change */
                        .status-indicator,
                        .status-text {
                            transition: all 0.3s ease-in-out;
                        }
                    </style>

                    <script>
                        function toggleStatus() {
                            const toggle = document.getElementById('status-toggle');
                            const hiddenInput = document.getElementById('status-input');
                            const track = document.querySelector('.toggle-track');
                            const thumb = document.querySelector('.toggle-thumb');
                            const indicator = document.querySelector('.status-indicator');
                            const text = document.querySelector('.status-text');

                            if (toggle.checked) {
                                // Switch to Available
                                hiddenInput.value = 'available';
                                track.classList.remove('bg-red-500');
                                track.classList.add('bg-green-500');
                                thumb.classList.add('translate-x-7');
                                thumb.classList.remove('translate-x-0');
                                indicator.textContent = '🟢';
                                text.textContent = 'Available';
                            } else {
                                // Switch to Unavailable  
                                hiddenInput.value = 'unavailable';
                                track.classList.remove('bg-green-500');
                                track.classList.add('bg-red-500');
                                thumb.classList.remove('translate-x-7');
                                thumb.classList.add('translate-x-0');
                                indicator.textContent = '🔴';
                                text.textContent = 'Unavailable';
                            }
                        }

                        // Initialize on page load
                        document.addEventListener('DOMContentLoaded', function() {
                            const toggle = document.getElementById('status-toggle');
                            const track = document.querySelector('.toggle-track');
                            const thumb = document.querySelector('.toggle-thumb');

                            // Set initial state based on current status
                            if (toggle.checked) {
                                track.classList.add('bg-green-500');
                                thumb.classList.add('translate-x-7');
                            } else {
                                track.classList.add('bg-red-500');
                                thumb.classList.add('translate-x-0');
                            }
                        });
                    </script>
                </div>
                <input type="hidden" id="id" name="id" value="{{$Menu->id}}">
                <input type="hidden" id="mode" name="mode" value="edit">
                <input type="submit"
                    value="Save"class="border border-blue-600 bg-blue-400 p-2 px-10 rounded-lg mt-4 hover:bg-blue-700 cursor-pointer text-white">
            </div>
        </form>
    </div>
@endsection
