<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body>
    <div class="flex flex-1 bg-amber-100 border h-screen w-full items-center justify-center">
        <div class="flex flex-col items-center justify-center  bg-red-300 border p-10 rounded-2xl shadow-lg">
            <h1 class="text-4xl font-bold mb-4">Welcome sto the POS System</h1>
            <p class="text-lg mb-8">Please log in to continue.</p>
            <form action="login" method="POST" class="w-80">
                @csrf
                @error('login')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                @error('permission')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="phone" name="phone" id="phone" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>


                <button type="submit"
                    class="w-full bg-amber-400 text-white py-2 px-4 rounded-md hover:bg-amber-700">Login</button>


            </form>
        </div>
    </div>
</body>

</html>
