<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <script src="https://cdn.tailwindcss.com"></script>
    
</head>

<body>
    
    <div class="flex flex-1 flex-col items-center justify-center bg-gradient-to-br from-amber-400 via-amber-200 to-yellow-100 h-screen">
        <div class="flex w-1/2 flex-col items-center justify-center bg-white rounded-lg shadow-lg p-10 ">
            <div class="text-2xl border-b-4 p-4  ">POS Eample System With Laravel</div>
            <div class="grid  grid-cols-2 gap-10 p-5 items-center justify-center text-center ">
                <a class="flex flex-1 items-center justify-center border rounded-lg shadow-lg bg-white p-10 hover:scale-105 transition-transform duration-300 hover:font-semibold" href="{{ route('orderPage') }}">
                    <i class="bi bi-cup-straw mr-3"></i>Order Menu 
                </a>
                <a class="flex flex-1 items-center justify-center border rounded-lg shadow-lg bg-white p-10 hover:scale-110 transition-transform duration-300 hover:font-semibold" href="{{ route('addPage') }}">
                    <i class="bi bi-plus-square mr-3"></i>Add Menu
                </a>
                <a class="flex flex-1 items-center justify-center border rounded-lg shadow-lg bg-white p-10 hover:scale-110 transition-transform duration-300 hover:font-semibold" href="{{ route('editPage') }}">
                    <i class="bi bi-pencil-square mr-3"></i>Edit Menu
                </a>
                <a class="flex flex-1 items-center justify-center border rounded-lg shadow-lg bg-white p-10 hover:scale-110 transition-transform duration-300 hover:font-semibold" href="{{ route('allOrderPage') }}">
                    <i class="bi bi-receipt mr-3"></i>All Orders
                </a>
            </div>
        </div>
    </div>
</body>

</html>
