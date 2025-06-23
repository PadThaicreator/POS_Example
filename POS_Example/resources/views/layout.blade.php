<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title')</title>
</head>

<body>
    <div class="grid grid-cols-6 h-screen w-full ">
        <div class="flex flex-1 flex-col col-span-1  border bg-amber-200 p-4  items-center">
            <div>POS EXAMPLE SYSTEM</div>
            <div class="grid grid-rows-4 gap-5 mt-10 text-center">
                <a href="#" class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300">Order Menu</a>
                <a href="#" class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300" >Add Menu</a>
                <a href="#" class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300">Edit Menu</a>
                <a href="#" class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300">Sell Orders</a>
            </div>
        </div>
        <div class="col-span-5  border bg-amber-100 p-4">
            @yield('content')
        </div>
    </div>
</body>

</html>
