@extends('search')

@section('window') 
@if (Route::has('login'))
    @auth
    <div id="popup-review" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed flex-col inset-x-0 mx-auto my-auto z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Review popup content -->
            <div class="relative bg-white rounded-lg shadow">
                 <!-- Review popup header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        How was your ride, {{ Auth::user()->name }}?
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="review();">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Exit</span>
                    </button>
                </div>
                 <!-- Review popup body -->
                <form class="p-4 md:p-5" method="POST" action="{{ route('result_info') }}">
@csrf
    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="col-span-2 flex flex-row mx-auto">
            <div class="flex flex-col mr-1">
                <x-label for="pickup" value="{{ __('Pick-Up Location') }}" />
                <!-- Removed the suggestion div - Google handles this -->
                <x-input id="pickup" 
                         class="block mt-1 w-full" 
                         type="text" 
                         name="pickup" 
                         maxlength="255" 
                         placeholder="Enter pickup location..." 
                         required 
                         autocomplete="off" />
            </div>
            <div class="flex flex-col ml-1">
                <x-label for="destination" value="{{ __('Destination') }}" />
                <!-- Removed the suggestion div - Google handles this -->
                <x-input id="destination" 
                         class="block mt-1 w-full" 
                         type="text" 
                         name="destination" 
                         maxlength="255" 
                         placeholder="Enter destination..." 
                         required 
                         autocomplete="off" />
            </div>
        </div>
                        <div class="col-span-2 flex flex-row mx-auto bg-gray-400 rounded-md px-3 py-2 justify-center w-full">
                            <x-label for="rating" value="{{ __('Rating') }}" />
                            <x-input id="rating" class="block mt-1 w-1/4 ml-2 text-center" type="number" name="rating" value="1" min="1" max="5" step="1" required autofocus/>
          
                            <div class="flex flex-row items-center text-center ml-3">
                                <div class="flex items-center my-1 pr-1 py-3">
                            
                                    <svg id="star1" class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg id="star2" class="w-4 h-4 ms-1 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg id="star3" class="w-4 h-4 ms-1 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg id="star4" class="w-4 h-4 ms-1 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <svg id="star5" class="w-4 h-4 ms-1 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-span-2">
                            <x-label for="comment" value="{{ __('Comment') }}" />
                            <textarea id="comment" name="comment" rows="4" value="" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2" placeholder="Feel free to share your thoughts" required></textarea>                    
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-button class="mt-1"  id="ride_review">
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                    <input type="hidden" name="plate_no" id="search_query" value="{{ $search_query }}">
                    <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                </form>
            </div>
        </div>
    </div>
    
    <div id="popup-delete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed flex-col inset-x-0 mx-auto my-auto z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                 <!-- Delete popup content -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Permanently delete this review?
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="delreview(-1);">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Exit</span>
                    </button>
                </div>
                 <!-- Delete popup button -->
                <form class="p-4 md:p-5" method="POST" action="{{ route('delete_review') }}">
                @csrf
                    <div class="flex justify-center">
                        <x-button class="mt-1">
                            {{ __('Delete') }}
                        </x-button>
                    </div>
                    <input type="hidden" name="plate_no" id="search_query" value="{{ $search_query }}">
                    <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                    <input type="hidden" name="review_id" id="delrev" value="">
                </form>
            </div>
        </div>
    </div>
     <!-- Fade to black -->
    <div class="hidden fixed top-0 left-0 w-full h-full bg-black opacity-50 z-40" id="blackscrn"></div>
    @endauth
@endif
@endsection

@section('results')
<div class="container mx-auto px-4 py-2">

        <div class="bg-white rounded-lg shadow-md p-8 my-2">
             <!-- Tricycle information -->
             @php
                if(isset($dashboard) && $dashboard == 1) $prev_route =  route('redirect');
                else $prev_route = route('result_prev', ['search_query' => $search_query]);
             @endphp
            <a href="{{ $prev_route }}" class="mb-2 ms-2 inline-flex items-center px-3 py-3 bg-purple-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-800 focus:bg-purple-900 active:bg-purple-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="h-4 w-4 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                </svg>
            </a>

            <div class="flex flex-col items-center justify-between mx-4 text-center">
                <div class="border border-slate-700 rounded-xl p-2 my-1">
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
                 <!-- Tricycle average rating -->
                <div class="flex flex-row items-center text-center">
                    <div class="flex items-center bg-gray-400 mb-1 pr-1 rounded-md py-2">
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
                    <p class="py-1 mx-2 text-xl">{{ $reviews->count() }} 
                    @if ($reviews->count() === 1)
                        Review
                    @else
                        Reviews
                    @endif
                    </p>
                </div>
            </div>
             <!-- Add review button -->
            @if (Route::has('login'))
                @auth
                <div class="flex flex-col items-center justify-between text-center">
                    <a href="javascript:void(0);" onclick="review();" class="my-3 inline-flex items-center px-4 py-2 bg-purple-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-800 focus:bg-purple-900 active:bg-purple-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Add Review') }}
                    </a>
                </div>
                @endauth
            @endif
             <!-- Reviews -->
            @if ($reviews->count() > 0 && $persons != NULL)
            <section class="bg-gray-300 rounded-lg py-8 lg:py-16 antialiased">
                <div class="max-w-2xl mx-auto px-4">
                    @foreach ($reviews as $review)
                    <article class="px-6 py-3 mb-3 text-base bg-white rounded-lg border-l border-purple-600">
                        <footer class="flex justify-between items-center mb-2">
                            <div class="flex flex-col items-center">
                                 <!-- Individual review rating -->
                                <div class="flex mr-auto justify-start bg-none mt-1 pr-1 rounded-md">
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
                                 <!-- Reviewer's name -->
                                <div class="flex items-center">
                                    @foreach ($persons as $person)
                                        @if ($person->user_id === $review->user_id)
                                            @if (Auth::user() == NULL || Auth::user()->id != $person->user_id)
                                                <p class="inline-flex items-center mr-3 text-lg text-gray-500 font-semibold">
                                                    {{$person->fname}} {{$person->lname}} 
                                                </p>
                                                <p class="text-xs text-gray-600 font-bold">
                                                @if ($person->type === "Senior") Senior Commuter
                                                @elseif ($person->type === "PWD") PWD Commuter
                                                @elseif ($person->type === "Student") Student Commuter
                                                @else Regular Commuter
                                                @endif </p>
                                            @else
                                                <p class="inline-flex items-center mr-3 text-lg text-purple-900 font-bold">
                                                    {{$person->fname}} {{$person->lname}}<span class="font-light text-sm ml-2"> (You)</span>
                                                </p>
                                            @endif
                                            @break
                                        @endif
                                    @endforeach
                                    
                                </div>
                            </div>
                             <!-- Review delete button -->
                            @if (Auth::user() != NULL)
                                @if (Auth::user() && (Auth::user()->id === $review->user_id || Auth::user()->access === 1))
                                <button id="delete-review" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-purple-600"
                                    onclick="delreview('{{ $review->id }}');" type="button">
                                    <svg class="h-4 w-4 text-gray-800"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6" />
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                    <span class="sr-only">Delete Review</span>
                                </button>
                                @endif
                            @endif
                        </footer>
                         <!-- Review content -->
                        <div class="inline-flex ml-auto justify-end">
                            <p class="text-xs text-gray-900 font-light"><time>{{$review->updated_at->format('M-d-y')}}</time><br> From {{$review->pickup}}, to {{$review->destination}}.</p>
                        </div>
                        <p class="text-gray-900">{{$review->comment}}</p>
                        <div class="flex items-center mt-4 space-x-4">
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>
            @endif
        </div>  

</div>
@endsection

@section('review') 
<script>
    let pickupAutocomplete, destinationAutocomplete;
    let isGoogleLoaded = false;
    
    function getShortPlaceName(place) {
        if (place.name && place.name !== place.formatted_address) {
            let city = '';
            if (place.address_components) {
                for (let component of place.address_components) {
                    if (component.types.includes('locality') || 
                        component.types.includes('administrative_area_level_2')) {
                        city = component.long_name;
                        break;
                    }
                }
            }
            if (place.name.includes(city)) return `${place.name}`;
            if (city === place.name) return `${city}`;
            return city ? `${place.name} (${city})` : place.name;
        }
        
        //If no business name, extract barangay and city
        if (place.address_components) {
            let barangay = '';
            let city = '';
            
            for (let component of place.address_components) {
                if (component.types.includes('sublocality_level_1') || 
                    component.types.includes('neighborhood')) {
                    barangay = component.long_name;
                } else if (component.types.includes('locality') || 
                          component.types.includes('administrative_area_level_2')) {
                    city = component.long_name;
                }
            }
            
            if (barangay && city) {
                return `${barangay} (${city})`;
            } else if (city) {
                return city;
            }
        }
        
        //Default
        return place.formatted_address || place.name || '';
    }
    
    //Google Places Autocomplete
    function initializeGooglePlaces() {
        try {
            const pickupInput = document.getElementById('pickup');
            const destinationInput = document.getElementById('destination');
            
            if (!pickupInput || !destinationInput) {
                console.error('Input fields not found');
                return;
            }
            
            const options = {
                types: ['establishment', 'geocode'],
                componentRestrictions: { country: 'PH' },
                bounds: { north: 18.6500, south: 17.5000, east: 120.9000, west: 120.2000 },
                location: new google.maps.LatLng(18.1969, 120.5937), //Laoag City center
                radius: 50000, //50km
                strictBounds: true,
                fields: ['formatted_address', 'name', 'address_components']
            };
            
            //Initialize instances
            pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, options);
            destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput, options);
            
            //Place selection
            pickupAutocomplete.addListener('place_changed', function() {
                const place = pickupAutocomplete.getPlace();
                if (place) {
                    const shortName = getShortPlaceName(place);
                    pickupInput.value = shortName;
                }
            });
            destinationAutocomplete.addListener('place_changed', function() {
                const place = destinationAutocomplete.getPlace();
                if (place) {
                    const shortName = getShortPlaceName(place);
                    destinationInput.value = shortName;
                }
            });
            
            //Prevent Enter key from submitting form in autocomplete fields
            pickupInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
            destinationInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
            
            isGoogleLoaded = true;
            console.log('Google Places Autocomplete initialized successfully');
            
        } catch (error) {
            console.error('Error initializing Google Places:', error);
            isGoogleLoaded = false;
        }
    }

    //Callback function
    window.initMap = function() {
        initializeGooglePlaces();
    };
    
    function review(){
        if($('#blackscrn').css('display') === 'none'){
            $('#blackscrn').fadeIn();
            $('#popup-review').css("display", "flex").hide().fadeIn();
        }
        else{
            $('#blackscrn').fadeOut();
            $('#popup-review').fadeOut();
        }
    }

    function delreview(review_id){
        if($('#blackscrn').css('display') === 'none' && review_id > 0){
            $('#blackscrn').fadeIn();
            $('#popup-delete').css("display", "flex").hide().fadeIn();
            $('#delrev').val(review_id);
        }
        else{
            $('#blackscrn').fadeOut();
            $('#popup-delete').fadeOut();
            $('#delrev').val('');
        }
    }

    $(document).ready(function() {

        //Initialize Google Places if loaded
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            initializeGooglePlaces();
        }
        
        $('#rating').change(function(){
            updateStars($('#rating').val());
        });

        //Star display
        function updateStars(rating) {
            for(i = 2; i < 6; i++){   
                if(rating < i)
                    $('#star'+i).removeClass('text-yellow-300').addClass('text-gray-500');
                else
                    $('#star'+i).removeClass('text-gray-500').addClass('text-yellow-300');
            }
        }

        for(let i = 1; i < 6; i++) {
            $('#star' + i)
                .hover(
                    function() {
                        //Mouse enter
                        const starNum = parseInt($(this).attr('id').replace('star', ''));
                        updateStars(starNum);
                    },
                    function() {
                        //Mouse leave
                        updateStars($('#rating').val());
                    }
                )
                .click(function() {
                    const starNum = parseInt($(this).attr('id').replace('star', ''));
                    $('#rating').val(starNum).trigger('change');
                });
        }
        
        $('form').on('submit', function(e) {

            const submitButton = $(document.activeElement);
            if (submitButton.text().trim().toUpperCase() !== 'SUBMIT') {
                return true; 
            }

            const pickupValue = $('#pickup').val().trim();
            const destinationValue = $('#destination').val().trim();
            
            //Input validations
            if (!pickupValue || pickupValue.length < 3) {
                e.preventDefault();
                alert('Please enter a valid pickup location');
                return false;
            }
            
            if (!destinationValue || destinationValue.length < 3) {
                e.preventDefault();
                alert('Please enter a valid destination');
                return false;
            }
        
            const rating = $('#rating').val();
            const comment = $('#comment').val().trim();
            
            if (!rating || rating < 1 || rating > 5) {
                e.preventDefault();
                alert('Please select a valid rating');
                return false;
            }
            
            if (!comment || comment.length < 2) {
                e.preventDefault();
                alert('Please enter a comment');
                return false;
            }
            
            return true;
        });
        
        $('#ride_review').click(function(e) {
            $(this).closest('form').submit();
        });
    });

    var currdate = new Date().toISOString().slice(0, 10);
    
    //Error handling API loading
    window.gm_authFailure = function() {
        console.error('Google Maps API authentication failed');
        alert('Google Maps API failed to load. Please refresh the page or contact support.');
    };
</script>
@if (Route::has('login'))
    @auth
        @if (Auth::user()->access === 0)
            @foreach($reviews as $review)
                @php 
                    $review_date = $review->updated_at->format('Y-m-d');
                @endphp
                <script>
                        if ('{{ $review_date }}' === currdate 
                        && '{{ $review->user_id }}' === '{{ Auth::user()->id }}' 
                        && '{{ $review->tricycle_id }}' === '{{ $driver->tricycle_id }}') {

                            $('#ride_review').click(function(event){
                                event.preventDefault();
                                alert("You are attempting to submit multiple reviews in a short period of time, please try again later.");
                            });

                        }
                </script>
                @break
            @endforeach
        @endif
    @endauth
@endif

@endsection
