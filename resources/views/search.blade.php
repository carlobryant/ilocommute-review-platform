@extends('layouts.master')

@section('popup')
    @yield('window')
@endsection

@section('content')
    <header class="bg-purple-950 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('result') }}">
            @csrf
                <div class="flex flex-row mt-2 w-3/4 py-1 mx-auto">
                    <x-input id="plate_no" class="block mt-1 w-full text-lg text-center" type="text" maxlength="6" 
                    name="plate_no" placeholder="Enter Tricycle's Plate Number" oninput="this.value = this.value.toUpperCase()" 
                    autocomplete="off" required value="{{ $search_query }}"/>
                    <x-button class="mt-1">
                        <svg class="h-6 w-6 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        {{ __('Search') }}
                    </x-button>
                </div>
            </form>
        </div>
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                @yield('results') 
            </div>
        </div>
    </div>
@endsection

@section('script')
    @yield('review') 
@endsection