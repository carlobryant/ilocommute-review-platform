<x-app-layout>
<div id="popup-new" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed flex-col inset-x-0 mx-auto my-auto z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- New driver popup content -->
            <div class="relative bg-white rounded-lg shadow">
                 <!-- New driver popup header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Add a new tricycle in the database:
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="newdriver();">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Exit</span>
                    </button>
                </div>
                 <!-- New driver popup body -->
                <form class="p-4 md:p-5" method="POST" action="{{ route('create_driver') }}" id="newform">
                @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 flex flex-row mx-auto">
                            <x-label for="new_plate_no" value="{{ __('Plate Number') }}" />
                            <x-input id="new_plate_no" class="block mt-1 w-full" type="text" name="new_plate_no" maxlength="6" oninput="this.value = this.value.toUpperCase()" autocomplete="off" required autofocus/>
                        </div>
                        <div class="col-span-2 flex flex-row mx-auto">
                            <div class="flex flex-col mr-1 w-2/3">
                                <x-label for="new_city" value="{{ __('City / Municipality') }}" />
                                <select class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                                name="new_city" required>
                                    <option disabled selected value> Select an Option </option>
                                    <option value="Batac City">Batac City</option>
                                    <option value="Laoag City">Laoag City</option>
                                    <option value="Adams">Adams</option>
                                    <option value="Bacarra">Bacarra</option>
                                    <option value="Badoc">Badoc</option>
                                    <option value="Bangui">Bangui</option>
                                    <option value="Banna">Banna</option>
                                    <option value="Burgos">Burgos</option>
                                    <option value="Carasi">Carasi</option>
                                    <option value="Currimao">Currimao</option>
                                    <option value="Dingras">Dingras</option>
                                    <option value="Dumalneg">Dumalneg</option>
                                    <option value="Marcos">Marcos</option>
                                    <option value="Nueva Era">Nueva Era</option>
                                    <option value="Pagudpud">Pagudpud</option>
                                    <option value="Paoay">Paoay</option>
                                    <option value="Pasuquin">Pasuquin</option>
                                    <option value="Piddig">Piddig</option>
                                    <option value="Pinili">Pinili</option>
                                    <option value="San Nicolas">San Nicolas</option>
                                    <option value="Sarrat">Sarrat</option>
                                    <option value="Solsona">Solsona</option>
                                    <option value="Vintar">Vintar</option>
                                </select>
                            </div>
                            <div class="flex flex-col ml-1 w-1/3">
                                <x-label for="new_brgy" value="{{ __('Barangay') }}" />
                                <x-input class="block mt-1 w-full" type="text" name="new_brgy" maxlength="5" oninput="this.value = this.value.toUpperCase()" required autofocus />
                            </div>
                        </div>
                    
                    </div>
                    <div class="flex justify-end">
                        <x-button class="mt-1"  id="add_ride">
                            {{ __('Add') }}
                        </x-button>
                    </div>
                    <input hidden id="city_selc" name="city" value="{{ $city }}">
                    <input hidden id="search_selc" name="search_query" value="{{ $search_query }}">
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
                            Permanently delete tricycle <span id="trike_no"></span>?
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="deldriver(-1, -1);">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Exit</span>
                        </button>
                    </div>
                    <!-- Delete popup button -->
                    <form class="p-4 md:p-5" method="POST" action="{{ route('delete_drivers') }}" id="delform">
                    @csrf
                        <div class="flex justify-center">
                            <x-button class="mt-1">
                                {{ __('Delete') }}
                            </x-button>
                        </div>
                        <input hidden id="del_id" name="id" value="">
                        <input hidden id="city_selc" name="city" value="{{ $city }}">
                        <input hidden id="search_selc" name="search_query" value="{{ $search_query }}">
                    </form>
                </div>
            </div>
    </div>
     <!-- Fade to black -->
     <div class="hidden fixed top-0 left-0 w-full h-full bg-black opacity-50 z-40" id="blackscrn"></div>

    <x-slot name="header">
        <div class="flex flex-row justify-left">
            <img src="{{asset('storage/ilocommute2.png')}}" class="h-20 -mt-10 mr-1">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Admin') }} 
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                
                <div id="features" class="mx-auto max-w-6xl p-2 pt-10">
                    <h2 class="text-center font-display text-3xl font-bold tracking-tight text-slate-900 md:text-4xl">
                        Drivers Database
                    </h2>

                    <div class="flex flex-row items-center justify-center mt-2">
                        <form method="POST" action="{{ route('search_drivers') }}" class="bg-gray-600 px-2 rounded-lg">
                        @csrf
                            <div class="flex flex-row mt-2 w-full py-8">
                                <select id="city" class="block mt-1 w-1/3 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                                name="city" required>
                                <option value="all" {{ old('city', $city ?? 'all') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="Batac City" {{ old('city', $city ?? '') == 'Batac City' ? 'selected' : '' }}>Batac City</option>
                                <option value="Laoag City" {{ old('city', $city ?? '') == 'Laoag City' ? 'selected' : '' }}>Laoag City</option>
                                <option value="Adams" {{ old('city', $city ?? '') == 'Adams' ? 'selected' : '' }}>Adams</option>
                                <option value="Bacarra" {{ old('city', $city ?? '') == 'Bacarra' ? 'selected' : '' }}>Bacarra</option>
                                <option value="Badoc" {{ old('city', $city ?? '') == 'Badoc' ? 'selected' : '' }}>Badoc</option>
                                <option value="Bangui" {{ old('city', $city ?? '') == 'Bangui' ? 'selected' : '' }}>Bangui</option>
                                <option value="Banna" {{ old('city', $city ?? '') == 'Banna' ? 'selected' : '' }}>Banna</option>
                                <option value="Burgos" {{ old('city', $city ?? '') == 'Burgos' ? 'selected' : '' }}>Burgos</option>
                                <option value="Carasi" {{ old('city', $city ?? '') == 'Carasi' ? 'selected' : '' }}>Carasi</option>
                                <option value="Currimao" {{ old('city', $city ?? '') == 'Currimao' ? 'selected' : '' }}>Currimao</option>
                                <option value="Dingras" {{ old('city', $city ?? '') == 'Dingras' ? 'selected' : '' }}>Dingras</option>
                                <option value="Dumalneg" {{ old('city', $city ?? '') == 'Dumalneg' ? 'selected' : '' }}>Dumalneg</option>
                                <option value="Marcos" {{ old('city', $city ?? '') == 'Marcos' ? 'selected' : '' }}>Marcos</option>
                                <option value="Nueva Era" {{ old('city', $city ?? '') == 'Nueva Era' ? 'selected' : '' }}>Nueva Era</option>
                                <option value="Pagudpud" {{ old('city', $city ?? '') == 'Pagudpud' ? 'selected' : '' }}>Pagudpud</option>
                                <option value="Paoay" {{ old('city', $city ?? '') == 'Paoay' ? 'selected' : '' }}>Paoay</option>
                                <option value="Pasuquin" {{ old('city', $city ?? '') == 'Pasuquin' ? 'selected' : '' }}>Pasuquin</option>
                                <option value="Piddig" {{ old('city', $city ?? '') == 'Piddig' ? 'selected' : '' }}>Piddig</option>
                                <option value="Pinili" {{ old('city', $city ?? '') == 'Pinili' ? 'selected' : '' }}>Pinili</option>
                                <option value="San Nicolas" {{ old('city', $city ?? '') == 'San Nicolas' ? 'selected' : '' }}>San Nicolas</option>
                                <option value="Sarrat" {{ old('city', $city ?? '') == 'Sarrat' ? 'selected' : '' }}>Sarrat</option>
                                <option value="Solsona" {{ old('city', $city ?? '') == 'Solsona' ? 'selected' : '' }}>Solsona</option>
                                <option value="Vintar" {{ old('city', $city ?? '') == 'Vintar' ? 'selected' : '' }}>Vintar</option>
                                </select>
                                @if($search_query == 'ilocommute')
                                <x-input id="plate_no" class="block mt-1 mx-2 w-2/3 text-lg text-center" type="text" maxlength="6" name="search_query" placeholder="Plate Number" oninput="this.value = this.value.toUpperCase()" autocomplete="off" autofocus/>
                                @else
                                <x-input id="plate_no" class="block mt-1 mx-2 w-2/3 text-lg text-center" type="text" maxlength="6" name="search_query" value="{{ $search_query }}" placeholder="Plate Number" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>
                                @endif
                                <x-button class="mt-1">
                                    <svg class="h-6 w-6 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    {{ __('Search') }}
                                </x-button>
                            </div>
                        </form>

                        <div class="ml-2 bg-purple-700 rounded-lg py-7 px-2">
                            <a onclick="newdriver();" class="mt-3 mb-1 cursor-pointer inline-flex items-center px-3 py-3 bg-purple-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-800 focus:bg-purple-900 active:bg-purple-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="h-5 w-5 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="4" y="4" width="6" height="6" rx="1" />  <rect x="4" y="14" width="6" height="6" rx="1" />  <rect x="14" y="14" width="6" height="6" rx="1" />  <line x1="14" y1="7" x2="20" y2="7" />  <line x1="17" y1="4" x2="17" y2="10" />
                                </svg>
                                {{ __(' Add New') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-200 px-2 py-5 overflow-x-scroll">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plate Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City / Municipality</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Baranggay</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Average Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($drivers as $driver)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $driver->plate_no }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $driver->city }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $driver->brgy }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center bg-none mt-1 pr-1 rounded-md">
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
                            </td>

                            <td class="px-6 py-4 flex flex-row whitespace-nowrap">
                                <button id="del{{ $driver->id }}" onclick="deldriver('{{ $driver->id }}','{{ $driver->plate_no }}');" class="mt-2 ml-1 inline-flex items-center px-3 py-3 bg-purple-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-800 focus:bg-purple-900 active:bg-purple-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="h-4 w-4 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="3 6 5 6 21 6" /> 
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <h2 class="text-center my-8 font-display text-3xl font-bold tracking-tight text-gray-600 md:text-4xl">
                                    No results found.
                                </h2>
                            </td>
                        </tr>
                        
                        @endforelse
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        function deldriver(driver_id, trike_no){
        if($('#blackscrn').css('display') === 'none' && driver_id > 0){
                $('#blackscrn').fadeIn();
                $('#popup-delete').css("display", "flex").hide().fadeIn();
                $('#del_id').val(driver_id);

                $('#trike_no').text(trike_no);

                let city = $('#city').val();
                let search = $('#plate_no').val();

                if(city !== 'all') $('#delform #city_selc').val(city);
                if(search !== 'ilocommute'&& search !== NULL) $('#delform #search_selc').val(search);
                else $('#delform #search_selc').val('ilocommute');
            }

            else{
                $('#blackscrn').fadeOut();
                $('#popup-delete').fadeOut();
                $('#del_id').val('');
            }
        }

        function newdriver(){
        if($('#blackscrn').css('display') === 'none'){
                $('#blackscrn').fadeIn();
                $('#popup-new').css("display", "flex").hide().fadeIn();

                let city = $('#city').val();
                let search = $('#plate_no').val();
                $('#newform #city_selc').val(city);
                $('#newform #search_selc').val(search);
            }

            else{
                $('#blackscrn').fadeOut();
                $('#popup-new').fadeOut();
            }
    }
    </script>

    @foreach($drivers as $driver)
        <script>
            $('#add_ride').click(function(event){
                if ('{{ $driver->plate_no }}' === $('#new_plate_no').val())
                {
                    event.preventDefault();
                    alert("This Plate Number already exists, please check again.");
                }
            });
        </script>
    @break
    @endforeach
</x-app-layout>
