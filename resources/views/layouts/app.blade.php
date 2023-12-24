<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BRBRS') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />
    <script type="module" src="https://unpkg.com/@material-tailwind/html@latest/scripts/popover.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}


    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>   --}}
    
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<style>
    [x-cloak] {
        display: none;
    }
</style>

<x-message/>

<body>
    <div id="app">
        @if (View::hasSection('nav'))
            <nav :class="{'flex': open, 'hidden': !open}" class="antialiased bg-green-800 dark-mode:bg-gray-900 w-full">
                <div class="mx-20">
                    <div class="flex w-full text-gray-700 bg--green-800 dark-mode:text-gray-200 dark-mode:bg-gray-800">
                        <div x-data="{ open: true }"
                            class="flex w-full flex-col bg-green-800 text-white px-4 md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
                            <div class="h-10 w-10">
                                <img src="../Login/CvSU logo.png" alt="">
                            </div>
                            <div class="flex flex-row items-center justify-between p-4">
                                <a href="{{ route('dashboard') }}"                     
                                    class="text-lg text-white font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
                                    Library Borrowing and Returning System
                                </a>
                                <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline"
                                    @click="open = !open">
                                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                        <path x-show="!open" fill-rule="evenodd"
                                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                            clip-rule="evenodd"></path>
                                        <path x-show="open" fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <div 
                                class="flex-col mt-2 flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
                                <a href="{{ route('dashboard') }}"
                                class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg md:mt-0 md:ml-4  
                                @if(request()->is('home')) bg-gray-200 text-gray-900 @else bg-transparent text-white-600 hover:text-gray-900 @endif 
                                hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline no-underline">
                                Dashboard
                                </a>
                            
                                <a href="{{ route('listbooks') }}"
                                    class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg md:mt-0 md:ml-4 
                                        @if(request()->is('listbooks')) bg-gray-200 text-gray-900 @else bg-transparent text-white-600 hover:text-gray-900 @endif 
                                        hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                    List of Books
                                </a>
                                    <a href="{{ route('historybooks') }}"
                                    class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg md:mt-0 md:ml-4 
                                        @if(request()->is('historybooks')) bg-gray-200 text-gray-900 @else bg-transparent text-white-600 hover:text-gray-900 @endif 
                                        hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                    Borrowing History
                                </a>
                                <a href="{{ route('patron') }}"
                                class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg md:mt-0 md:ml-4 
                                    @if(request()->is('patron')) bg-gray-200 text-gray-900 @else bg-transparent text-white-600 hover:text-gray-900 @endif 
                                    hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                Library Patrons
                                </a>
                                
                                <div
                                    class="ml-4 mt-2 hover:text-gray-900 focus:text-gray-900 rounded-md hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                    <div class="flex gap-2 p-1">
                                        <img alt="tania andrew"
                                            src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1480&amp;q=80"
                                            class="relative inline-block h-7 w-7 cursor-pointer rounded-full object-cover object-center"
                                            data-popover-target="profile-menu" />
                                        <div class="flex justify-center items-center cursor-pointer">
                                            <p class="font-medium text-md" data-popover-target="profile-menu">{{ Auth::user()->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <ul role="menu" data-popover="profile-menu" data-popover-placement="bottom"
                                        class="absolute z-10 flex min-w-[180px] flex-col gap-2 overflow-auto rounded-md border border-blue-gray-50 bg-white p-1 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
                                        <button tabIndex="-1" role="menuitem"
                                            class="flex w-full cursor-pointer select-none items-center gap-2 rounded-md px-3 pt-[9px] pb-1 text-start leading-tight outline-none transition-all hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z">
                                                </path>
                                            </svg>
                                            <p
                                                class="block font-sans text-sm font-normal leading-normal text-inherit antialiased">
                                                Account Setting
                                            </p>
                                        </button>
                                        <hr class="border-blue-gray-50" tabindex="-1" role="menuitem" />
                                        <button tabIndex="-1" role="menuitem"
                                            class="flex w-full cursor-pointer select-none items-center gap-2 rounded-md px-3 pb-1 text-start leading-tight outline-none transition-all hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" aria-hidden="true" class="h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5.636 5.636a9 9 0 1012.728 0M12 3v9"></path>
                                            </svg>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                            class="block font-sans text-sm font-normal leading-normal text-inherit antialiased">
                                            Sign Out
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </button>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        @endif

       
  
        <main>
            @yield('content')
        </main>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
        
    </div>
</body>
</html>
