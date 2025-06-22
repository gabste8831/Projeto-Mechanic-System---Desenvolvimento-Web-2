<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema de Mecânicos') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-mechanic-gray-50">
    <div id="app">
        <nav class="bg-mechanic-gray-800 border-b border-mechanic-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="text-white font-bold text-xl">
                                🔧 Sistema de Mecânicos
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-mechanic-gray-300 hover:text-white hover:border-mechanic-gray-300 focus:outline-none focus:text-white focus:border-mechanic-gray-300 transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                            <a href="{{ route('mechanics.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-mechanic-gray-300 hover:text-white hover:border-mechanic-gray-300 focus:outline-none focus:text-white focus:border-mechanic-gray-300 transition duration-150 ease-in-out">
                                Mecânicos
                            </a>
                            <a href="{{ route('cars.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-mechanic-gray-300 hover:text-white hover:border-mechanic-gray-300 focus:outline-none focus:text-white focus:border-mechanic-gray-300 transition duration-150 ease-in-out">
                                Carros
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        @guest
                            <a href="{{ route('login') }}" class="text-mechanic-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="text-mechanic-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Registro</a>
                        @else
                            <div class="ml-3 relative">
                                <div class="text-mechanic-gray-300">
                                    {{ Auth::user()->name }}
                                </div>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-mechanic-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
