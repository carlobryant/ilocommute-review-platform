@extends('search')

@section('window') 
@endsection

@section('results')
<div class="container mx-auto px-4 py-2">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($drivers as $driver)
        <div class="bg-white rounded-lg shadow-md p-8 my-2">
            <div class="flex flex-col items-center justify-between mx-4 text-center">
                <div class="border border-slate-700 rounded-xl p-2">
                    <table>
                        <tr>
                            <th colspan="2" class="my-0 py-0"><p class="text-gray-900 text-lg uppercase">{{$driver->city}}</p></th>
                        </tr>
                        <tr>
                            <td rowspan="2" class="my-0 py-0"><h3 class="text-5xl font-bold text-gray-900 mx-1"
                            style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" id="fixed">{{$driver->plate_no}}</h3></td>
                            <td class="my-0 py-0 align-text-bottom"><span class="text-gray-600 font-bold text-md">BRGY</span></td>
                        </tr>
                        <tr>
                            <td class="my-0 py-0 align-text-top"><span class="text-gray-600 font-bold text-lg">{{$driver->brgy}}</span></td>
                        </tr>
                    </table>
                </div>

                <div class="flex flex-row">
                    <div class="flex items-center bg-gray-400 mt-1 pr-1 rounded-md">
                    @php
                        $j = $driver->rating_tot;
                    @endphp
                    @for ($i = 0; $i < 5; $i++, $j--)
                        @if ($j > 0)
                        <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        @else
                        <svg class="w-4 h-4 ms-1 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                        @endif
                    @endfor
                    </div>
                    <form method="POST" action="{{ route('result_info') }}">
                    @csrf
                        <input type="hidden" name="plate_no" value="{{ $search_query }}">
                        <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                        <x-button class="mt-1 ml-1">
                            {{ __('View') }}
                        </x-button>
                    </form>
                </div>
                
            </div>
        </div>  
        @endforeach
    </div>
</div>
@endsection

@section('review') 
@endsection