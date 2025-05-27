<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ilocommute') }}</title>
        <link rel="icon" type="image/png" href="{{asset('storage/ilocommute.png')}}">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <style>
            *{
                font-family: "Segoe UI", Arial, sans-serif;
            }
        </style>
        @livewireStyles
    </head>
    <body class="antialiased">
        <x-banner />
        @php
        $bg = asset('storage/bgiloco2.jpg');
        @endphp
        <div class="min-h-screen bg-gray-100"  style="background-image: url('{{ $bg }}'); background-position: center bottom; background-attachment: fixed;">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-purple-950 shadow pt-24">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
