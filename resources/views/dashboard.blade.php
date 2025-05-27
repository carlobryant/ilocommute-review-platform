<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-left">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Welcome to ') }} 
            </h2>
            <img src="{{asset('storage/ilocommute2.png')}}" class="h-20 -mt-10 ml-2">
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-gray-200 px-2 py-10">
                <div id="features" class="mx-auto max-w-6xl">
                    @if (isset($reviews) && isset($drivers))
                    <h2 class="text-center font-display text-3xl font-bold tracking-tight text-slate-900 md:text-4xl">
                        Your Reviews
                    </h2>
                    
                    <ul class="mt-16 grid grid-cols-1 gap-6 text-center text-slate-700 md:grid-cols-3">
                        @foreach ($reviews as $review)
                        <li class="rounded-xl bg-white hover:bg-blue-300 hover:shadow-lg px-6 py-8 shadow-sm cursor-pointer">

                        @foreach ($drivers as $driver)
                            @if($review->driver_id === $driver->id)
                            <a href="{{ route('result_submit', ['search_query' => $driver->plate_no, 'driver_id' => $review->driver_id, 'dashboard' => 1]) }}">
                                <h3 class="mt-3 font-display font-medium">{{$review->updated_at->format('M-d-y')}}</h3>
                                <h3 class="mb-3 font-display text-xs font-medium">From {{$review->pickup}}, to {{$review->destination}}</h3>

                                    <div class="flex flex-col items-center justify-between mx-4 text-center">
                                        <div class="border border-slate-700 rounded-xl p-1">
                                            <table>
                                                <tr>
                                                    <th colspan="2" class="my-0 py-0"><p class="text-gray-900 text-sm uppercase">{{$driver->city}}</p></th>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2" class="my-0 py-0"><h3 class="text-3xl font-bold text-gray-900 mx-1"
                                                    style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" id="fixed">{{$driver->plate_no}}</h3></td>
                                                    <td class="my-0 py-0 align-text-bottom"><span class="text-gray-600 font-bold text-xs">BRGY</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="my-0 py-0 align-text-top"><span class="text-gray-600 font-bold text-sm">{{$driver->brgy}}</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    @break
                                    @endif

                                @endforeach
                                <div class="flex mr-auto justify-center bg-none mt-1 pr-1 rounded-md">
                                    @php
                                        $j = $review->rating;
                                    @endphp
                                    @for ($i = 0; $i < 5; $i++, $j--)
                                        @if ($j > 0)
                                        <svg class="w-4 h-4 text-purple-800 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4 ms-1 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                        @endif
                                    @endfor
                                    </div>
                            
                                <p class="mt-1.5 text-sm leading-6 text-secondary-500">{{ $review->comment }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    @else
                    <h2 class="text-center font-display text-3xl font-bold tracking-tight text-slate-900 md:text-4xl">
                        You currently have no reviews. 
                    </h2>
                    <div class="flex justify-center mt-5">
                    <a href="{{ route('welcome') }}" class="mb-2 ms-2 inline-flex items-center px-3 py-3 bg-purple-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-800 focus:bg-purple-900 active:bg-purple-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="h-4 w-4 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                        </svg>
                    </a>
                    </div>
                    @endif
                </div>
               
                <div>
            </div>
        </div>
    </div>
</x-app-layout>
