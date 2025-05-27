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
        <script>

    function handleGoogleMapsError() {
        console.error('Failed to load Google Maps API');
        $('#pickup, #destination').attr('placeholder', 'Enter location manually...');
    }
</script>

<script async defer 
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&loading=async&libraries=places&callback=initMap"
    onerror="handleGoogleMapsError()">
</script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <style>
            *
            {
                font-family: "Segoe UI", Arial, sans-serif;
            }

            input[type=number]::-webkit-inner-spin-button, 
            input[type=number]::-webkit-outer-spin-button
            {  
                opacity: 1;
            }
            .pac-container {
    width: auto !important;
    max-width: 400px; /* Adjust as needed */
}

.pac-item {
    white-space: normal !important; /* Allow text wrapping */
    word-wrap: break-word !important;
    line-height: 1.4 !important;
    padding: 8px 12px !important; /* Add more padding for readability */
    min-height: auto !important;
}

.pac-item-query {
    white-space: normal !important;
    word-wrap: break-word !important;
}

.pac-matched {
    white-space: normal !important;
    word-wrap: break-word !important;
}

/* Optional: Adjust the icon spacing */
.pac-icon {
    align-self: flex-start !important;
    margin-top: 2px !important;
}
            .pac-item:hover {
                background-color: #f3f4f6;
            }
            .pac-item:last-child {
                border-bottom: none;
            }
            .pac-item-selected {
                background-color: #e0e7ff !important;
            }
            #pickup-suggestions, #destination-suggestions {
                display: none !important;
            }
            #pickup, #destination {
                background-color: white !important;
                position: relative;
                z-index: 1;
            }
        </style>
        @livewireStyles
    </head>
    <body class="antialiased">
        @yield('popup') 
        <x-banner />
        @php
        $bg = asset('storage/bgiloco2.jpg');
        @endphp
        <div class="min-h-screen bg-gray-100" style="background-image: url('{{ $bg }}'); background-position: center bottom; background-attachment: fixed;">

            <!-- Page Heading -->
                <header class="bg-purple-700 shadow fixed top-0 w-full">
                    <div class="flex max-w-7xl mx-auto py-0 px-4 sm:px-6 lg:px-8">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <x-nav-link href="{{ url('/') }}">
                                    <x-application-mark class="block h-9 w-auto" />
                            </x-nav-link>
                        </div>
                        @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-5 p-6 text-right z-10">
                            @auth
                                <a href="{{ url('/redirect') }}" class="flex items-center font-semibold text-white hover:text-purple-300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-purple-500">
                                    <svg class="h-5 w-5 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> 
                                        <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="7" r="4" /> 
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg> {{ Auth::user()->name }}
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-white hover:text-purple-300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-purple-500">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-purple-300 focus:outline focus:outline-2 focus:rounded-sm focus:outline-purple-500">Register</a>
                                @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </header>

            <!-- Page Content -->
            <main>
                <div class="mt-14">
                @yield('content') 
                </div>
            </main>
        </div>
        @yield('script')
    </body>
</html>
