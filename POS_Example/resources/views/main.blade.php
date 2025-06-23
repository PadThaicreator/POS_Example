<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-1 flex-col items-center justify-center bg-gradient-to-br from-amber-400 via-amber-200 to-yellow-100 h-screen">
        <div class="text-2xl bg-blue-200 p-4 rounded-2xl shadow-2xl">POS Eample System With Laravel</div>
        <div class="grid  grid-cols-2 gap-10 p-5 items-center justify-center text-center">
            <a class="w-full h-full border rounded-lg shadow-lg bg-white p-10 hover:scale-105 transition-transform duration-300 hover:font-semibold" href="{{ route('order') }}">
                Order Menu
            </a>
            <div class="w-full h-full border rounded-lg shadow-lg bg-white p-10 hover:scale-110 transition-transform duration-300 hover:font-semibold">
                Add Menu
            </div>
            <div class="w-full h-full border rounded-lg shadow-lg bg-white p-10 hover:scale-110 transition-transform duration-300 hover:font-semibold" >
                Edit Menu
            </div>
            <div class="w-full h-full border rounded-lg shadow-lg bg-white p-10 hover:scale-110 transition-transform duration-300 hover:font-semibold">
                All Orders
            </div>
        </div>
    </div>
</body>

</html>
