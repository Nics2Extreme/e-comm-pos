<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body class="antialiased">
    <div class="hidden mx-auto bg-pink-500 p-4 md:block md:w-auto">
        <ul class="font-medium grid grid-cols-3 p-4 md:p-0 rounded-lg text-white">
            <li>
                <div class="flex justify-center items-center select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    <span class="text-sm">24/7 Service: +63- 9386020346</span>
                </div>
            </li>
            <li>
                <div class="flex justify-center items-center select-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <span class="text-sm">Email: ermelglassabdaluminum@gmail.com</span>
                </div>
            </li>
            <li>
                <div class="flex justify-center items-center select-none">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                        <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm"><a href="https://www.facebook.com/profile.php?id=100063716924276">Facebook: ERMEL Glass and Aluminum</a></span>
                </div>
            </li>
        </ul>
    </div>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
            </div>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <!-- @if (Route::has('login'))
                        @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else -->
                        <a href="./customer" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        <!-- @if (Route::has('register')) -->
                        <a href="./customer/register" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        <!-- @endif
                        @endauth
                        @endif -->
                    </li>
                    <li>
                        <a href="./customer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="controls-carousel" class="relative w-full" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('assets/img/landing/banner1.jfif') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                <img src="{{ asset('assets/img/landing/banner2.png') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset('assets/img/landing/banner3.jfif') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <!-- Content -->
    <div class="mx-auto px-2">
        <h1 class="my-6 text-3xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
            Crafting Brilliance in Glass and Aluminum Excellence</h1>
        <h1 class="my-6 text-2xl text-center leading-none tracking-tight text-gray-900 md:text-2xl lg:text-2xl dark:text-white">
            Nicolas Zamora St., Manila, Philippines, 1012</h1>
        <h3 class="my-6 text-2xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
            Service Offered</h3>
        <div class="flex">
            <div class="flex-1 text-center">
                <div class="relative inline-flex items-center w-50 px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
                    Sliding Window
                </div>
                <div class="relative inline-flex items-center w-50 px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
                    Sliding Doors
                </div>
                <div class="relative inline-flex items-center w-50 px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
                    Cr Doors
                </div>
                <div class="relative inline-flex items-center w-50 px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
                    Screen Doors
                </div>
                <div class="relative inline-flex items-center w-50 px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
                    Awnings
                </div>
                <div class="relative inline-flex items-center w-50 px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
                    Shelf
                </div>
                <div class="relative inline-flex items-center w-50 px-4 py-2 text-sm font-medium hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                    <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
                    Kitchen Cabinet
                </div>
            </div>
        </div>
        <div>
            <nav class="bg-white border-gray-200 dark:bg-gray-900 py-5">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <div href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="{{ asset('assets/img/favicon.png') }}" class="h-8" alt="Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Ermel Glass and Aluminum Supply</span>
                    </div>
                    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
            </nav>
            <div class="grid grid-cols-4 gap-4">
                <?php
                foreach ($products as $product) {
                ?>
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="./customer">
                            <img class="img-fluid" src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.png') }}">
                        </a>
                        <div class="p-5">
                            <a href="./customer">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->product_name }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">P {{ $product->selling_price }}</p>
                            <a href="./customer" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Buy Now
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <br>
        <h3 class="my-6 text-2xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
            Product Center</h3>
        <h1 class="my-6 text-3xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
            Learn About Our <span class="text-yellow-400">PRODUCTS</span></h1>
        <div class="grid grid-cols-4 gap-4 mx-auto px-2">
            <a href="./customer" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <img src="{{ asset('assets/img/landing/awning.jpg') }}" alt="Product" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Awnings</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Learn More ></p>
            </a>

            <a href="./customer" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <img src="{{ asset('assets/img/landing/cabinet.jpg') }}" alt="Product" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Kitchen Cabinets</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Learn More ></p>
            </a>

            <a href="./customer" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <img src="{{ asset('assets/img/landing/crdoor.jpg') }}" alt="Product" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">CR Doors</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Learn More ></p>
            </a>

            <a href="./customer" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <img src="{{ asset('assets/img/landing/screendoor.jpg') }}" alt="Product" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Screen Doors</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Learn More ></p>
            </a>

            <a href="./customer" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="Product" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Shelf</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Learn More ></p>
            </a>

            <a href="./customer" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <img src="{{ asset('assets/img/landing/slidingdoor.jpg') }}" alt="Product" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Sliding Doors</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Learn More ></p>
            </a>

            <a href="./customer" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <img src="{{ asset('assets/img/landing/slidingwindow.jpg') }}" alt="Product" />
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Sliding Window</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">Learn More ></p>
            </a>

        </div>
        <br>
        <div class="grid grid-cols-2 gap-4 mt-10">
            <div class="mx-auto px-4 py-3 text-justify">
                <h2 class="text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
                    About Us</h2>
                <h2 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
                    Welcome to <span class="text-yellow-400">Ermel Glass and Aluminum</span></h2>
                <br>
                <p>
                    Ermel Glass and Aluminum, where innovation meets reliability in the world of glass and aluminum solutions. As a leading provider in the industry, we take pride in offering an extensive range of high-quality products, including windows, doors, facades, and custom architectural elements. With a commitment to excellence, we ensure that our materials not only meet but exceed industry standards, providing our clients with durable, stylish, and technologically advanced solutions. Our dedicated team of experts brings a wealth of technical knowledge in manufacturing, installation, and maintenance, allowing us to tailor our services to meet the unique needs and design preferences of our clients.
                </p>
            </div>
            <div>
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="50%" class="mx-auto py-3">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-10">
            <div>
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="50%" class="mx-auto py-3">
            </div>
            <div class="mx-auto px-4 py-3 text-justify">
                <h2 class="text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
                    What can we do for you?</h2>
                <h2 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
                    Ermel can provide crafting brilliance <span class="text-yellow-400">RESOURCES</span>
                </h2>
                <br>
                <p>
                    1. Free quotation consulting services are available.<br>
                    2. We specialize in tailoring our glass and aluminum solutions to match the precise specifications of your project, ensuring a perfect fit and functionality.<br>
                    3. We strive to provide cost-effective solutions for your glass and aluminum needs.<br>
                    4. Our dedicated customer support team is ready to assist you at every step. From inquiries to after-sales service, we prioritize clear communication and customer satisfaction.<br>
                    5. Count on us for a reliable and efficient supply chain. We ensure timely delivery of materials to meet project deadlines and keep your operations running smoothly.<br>
                </p>
            </div>
        </div>
        <br>
        <div class="bg-pink-200 px-5 border border-pink-200 rounded-md">
            <h3 class="my-6 text-2xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
                Factory</h3>
            <h1 class="my-6 text-3xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white">
                Learn About Our <span class="text-yellow-400">FACTORY</span></h1>
            <div class="grid grid-cols-4 gap-4">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="80%" class="mx-auto py-3">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="80%" class="mx-auto py-3">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="80%" class="mx-auto py-3">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="80%" class="mx-auto py-3">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="80%" class="mx-auto py-3">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="80%" class="mx-auto py-3">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="80%" class="mx-auto py-3">
                <img src="{{ asset('assets/img/landing/shelf.jpg') }}" alt="img" width="80%" class="mx-auto py-3">
            </div>
        </div>

        <div style="background-color: #000000;" class="px-5 py-5">
            <h3 class="my-6 text-2xl text-center font-extrabold leading-none tracking-tight text-yellow-400 md:text-3xl lg:text-3xl dark:text-yellow-400">
                Services</h3>
            <h1 class="my-6 text-3xl text-center font-extrabold leading-none tracking-tight text-white md:text-3xl lg:text-3xl dark:text-white">
                Learn About Our <span class="text-yellow-400">Services</span></h1>
            <div class="grid grid-cols-4 gap-4">
                <div class="block max-w-sm p-6 mb-10 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Company Strength</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">The company excels in the glass and aluminum supply industry due to our commitment to excellence. We boast an extensive product range, ensuring we meet diverse industry needs with high-quality materials that adhere to or surpass industry standards.</p>
                </div>

                <div class="block max-w-sm p-6 mt-10 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Customized Business</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">The comapny allowing us to provide customized solutions tailored to the unique specifications and design preferences of our clients. We prioritize timley delivery through efficient supply chain management, ensuring our products meet project timelines.</p>
                </div>

                <div class="block max-w-sm p-6 mb-10 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Good Partnership</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">We prioritze environmentally conscious practices, maintain strong client relationships, comly with regulations, and provide exceptional customer support throughout every project.</p>
                </div>

                <div class="block max-w-sm p-6 mt-10 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">High Services</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">The company takes pride in delivering premium services in the glass and aluminum supply sector, setting a benchmark for excellence. Our comprehensive range includes top-notch materials for windows, doors, facades, and custom solutions.</p>
                </div>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="grid grid-cols-2 gap-4">
            <div class="float-left p-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>

                <h1 class="text-2xl font-extrabold leading-none tracking-tight text-white md:text-3xl lg:text-3xl dark:text-white">
                    <span class="text-yellow-400">INQUIRY PRICE</span>
                </h1>
                <p>We assure you that the majority of queries will be addressed within the stipulate time frame.</p>
            </div>
            <div class="p-5">
                <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input type="email" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-400 focus:border-yellow-400 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow-400 dark:focus:border-yellow-400" placeholder="email@example.com">
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">We’ll never share your details. Read our <a href="#" class="font-medium text-yellow-400 hover:underline dark:text-yellow-400">Privacy Policy</a>.</p>

            </div>
        </div>
    </div>


    <footer style="background-color: #000000;">
        <div class="mx-auto text-white w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/img/favicon.png') }}" class="h-8 me-3" alt="Logo" />
                        <span class="self-center text-1xl font-semibold whitespace-nowrap dark:text-white">ERMEL Glass and Aluminum</span>
                </div>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Contact Us</h2>
                        <ul class="text-white dark:text-white font-medium">
                            <li class="mb-4">
                                +63-9386020346
                            </li>
                            <li>
                                ermelglassabdaluminum@gmail.com
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">Contact Us</h2>
                        <ul class="text-white dark:text-white font-medium">
                            <li class="mb-4">
                                N. Zamora St., Manila, Philippines, 1012
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-white sm:mx-auto dark:border-white lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-white sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Ermel Glass and Aluminum™</a>. All Rights Reserved.
                </span>
                <div class="flex mt-4 sm:justify-center sm:mt-0">
                    <a href="https://www.facebook.com/profile.php?id=100063716924276" class="text-white hover:text-white dark:hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                            <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Facebook page</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.js" integrity="sha512-bUju8VkXhCQgW7zCHSdiIDpECo/lqzChkKrKoc1v2PL2XqO/0Q2Y8dhu07+q6Rk+1c1xr6cfE0VZnumgwy93Ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>