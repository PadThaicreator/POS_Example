


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <title>@yield('title')</title>
</head>

<body>
    <div class="grid   w-full grid-cols-7">
        <div class="flex flex-1 flex-col col-span-1  border bg-white border-r p-4  items-center h-screen sticky top-0">
              <div class="animate-text  text-xl font-semibold "> EXAMPLE SYSTEM</div>
            <div class="grid grid-rows-4 gap-5 mt-10 text-center">
                <a  class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300" href="{{ route('orderPage') }}">Order Menu</a>
                <a  class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300" href="{{ route('addPage') }}">Add Menu</a>
                <a  class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300" href="{{ route('editPage') }}">Edit Menu</a>
                <a  class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300" href="{{ route('allOrderPage') }}">All Orders</a>
                <a  class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300" href="{{ route('memberPage') }}">Member</a>
                <a  class="bg-white p-4 rounded-lg hover:shadow-lg hover:bg-gray-200 hover:scale-105 transition-all duration-300" href="{{ route('dashboardPage') }}">Dashboard</a>

            </div>
        </div>
        <div class="@yield('grid-col')   bg-gray-200 p-5 items-center justify-center">
           <div class=" bg-white flex flex-1  p-5 h-full rounded-lg shadow-lg">
               
             @yield('content')
           </div>
        </div>
        <div class="flex flex-1 @yield('show-cart') p-4">
                @yield('cart-content')
        </div>
    </div>
</body>

</html>
