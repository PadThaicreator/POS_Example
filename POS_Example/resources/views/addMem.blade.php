@extends('layout')

<?php $categories = ['staff', 'customer']; ?>

@section('title', 'Member')
@section('grid-col' ,'col-span-6') 
@section('show-cart' ,'hidden') 

@section('content')
    

    <div class="flex flex-1 items-center flex-col">
        <h1 class="text-2xl font-semibold mb-10">Add Member</h1>

        <form action="{{route('addMemForm')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-1 flex-col gap-4 items-center justify-center">
                <div class="grid grid-cols-2 gap-4 ">
                    <div class="flex flex-col gap-2">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName"class="border border-black p-2 rounded-lg w-full mt-2" placeholder="Enter First Name">
                        @error('firstName')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName"class="border border-black p-2 rounded-lg w-full mt-2" placeholder="Enter Last Name">
                        @error('lastName')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="nickname">Nickname</label>
                        <input type="text" id="nickname" name="nickname"class="border border-black p-2 rounded-lg w-full mt-2" placeholder="Enter Nickname">
                        @error('nickname')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" id="phoneNumber" name="phoneNumber"class="border border-black p-2 rounded-lg w-full mt-2" placeholder="Enter Phone Number">
                        @error('phoneNumber')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                     <div class="flex flex-col gap-2">
                        <label for="birthday">Birthday</label>
                        <input type="date" id="birthday" name="birthday"class="border border-black p-2 rounded-lg w-full mt-2" placeholder="Enter Phone Number">
                        @error('birthday')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="role">Member Role</label>
                        <select id="role" name="role" class="border border-black p-2 rounded-lg w-full mt-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <input type="hidden"  id="mode" name="mode" value="add">
                <div class="flex gap-3">
                <a href="{{route('memberPage')}}" class="border border-black bg-gray-400 p-2 px-10 rounded-lg mt-4 hover:bg-gray-700 cursor-pointer text-white">Go Back</a>
                <input type="submit" value="Save"class="border border-blue-600 bg-blue-400 p-2 px-10 rounded-lg mt-4 hover:bg-blue-700 cursor-pointer text-white">
            
                </div>    
            </div>
                
        </form>
    </div>
@endsection
