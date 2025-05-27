@extends('layouts.master')

@section('content')
<div class="flex flex-col justify-center items-center pt-5">
    <x-authentication-card-logo />
    <h2 style="margin-top: -2em; text-transform: uppercase; text-shadow: 0 1px 15px white;" class="text-base text-gray-700 font-extrabold pb-3">Where Every Voice Drives Progress</h2>
</div>

<div class="w-full sm:max-w-md mt-8 px-8 py-10 bg-purple-500 hover:bg-blue-400 hover:shadow-lg shadow-2xl overflow-hidden sm:rounded-lg mb-5 mx-auto">
    <form method="POST" action="{{ route('result') }}">
    @csrf
        <div class="flex flex-row mt-2 w-full py-8">
            <x-input id="plate_no" class="block mt-1 w-full text-lg text-center" type="text" maxlength="6" name="plate_no" placeholder="Enter Tricycle's Plate Number" oninput="this.value = this.value.toUpperCase()" autocomplete="off" required autofocus/>
            <x-button class="mt-1">
                <svg class="h-6 w-6 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                {{ __('Search') }}
            </x-button>
        </div>
    </form>
</div>
@endsection
