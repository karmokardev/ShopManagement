<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mine Shop</title>

    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#d8e1e8] flex items-center justify-center">
    <main class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <!-- Background Slanted Line -->
        <div class="absolute bottom-0 left-[65%] -z-0">
            <div class="w-24 h-[120vh] 
                    bg-gradient-to-b from-[#34adad] to-[#0B424C] 
                    transform -skew-x-12 origin-bottom">
            </div>
        </div>

        <div class="relative z-10 max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

            {{-- Left Content --}}
            <div class="text-center md:text-left">

                <h1 class="text-5xl md:text-6xl font-bold font-lobster mb-6 leading-tight">
                    Welcome to <span class="text-teal-600">Mine Shop</span>
                </h1>

                <p class="text-gray-600 text-md mb-8 max-w-lg mx-auto md:mx-0">
                    Your one-stop solution for complete shop management.
                    Manage products, track sales, monitor expenses and grow your business efficiently.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">

                    {{-- Login --}}
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 
                          bg-gradient-to-r from-teal-500 to-cyan-600 
                          text-white font-semibold rounded-xl 
                          shadow-md hover:shadow-xl 
                          hover:scale-105 transition-all duration-300">
                        Login
                    </a>

                    {{-- Register --}}
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 
                          border-2 border-teal-500 text-teal-600 
                          font-semibold rounded-xl 
                          hover:bg-teal-500 hover:text-white 
                          hover:shadow-xl hover:scale-105
                          transition-all duration-300">
                        Register
                    </a>

                </div>

            </div>

            {{-- Right Image --}}
            <div class="flex justify-center relative z-10">
                <img src="{{ asset('images/shop.png') }}" alt="Shop Management"
                    class="w-full max-w-md md:max-w-lg object-contain">
            </div>

        </div>

    </main>
</body>

</html>