<x-app-layout>

<div id="popup-delete" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed flex-col inset-x-0 mx-auto my-auto z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                 <!-- Delete popup content -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Permanently delete this user?
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" onclick="deluser(-1);">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Exit</span>
                    </button>
                </div>
                 <!-- Delete popup button -->
                <form class="p-4 md:p-5" method="POST" action="{{ route('delete_users') }}">
                @csrf
                    <div class="flex justify-center">
                        <x-button class="mt-1">
                            {{ __('Delete') }}
                        </x-button>
                    </div>
                    <input hidden id="del_id" name="id" value="">
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
                            Registered Users
                        </h2>
                </div>
                <div class="bg-gray-200 px-2 py-10 overflow-x-scroll">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            @foreach ($persons as $person)
                                @if ($user->id === $person->user_id)
                                <td class="px-6 py-4 whitespace-nowrap">{{ $person->fname }} {{ $person->lname }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select id="type{{ $user->id }}" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                                    name="type">
                                        @if ($person->type === "Regular")
                                        <option value="Regular" selected>Regular Commuter</option>
                                        <option value="Student">Student Commuter</option>
                                        <option value="PWD">PWD Commuter</option>
                                        <option value="Senior">Senior Citizen Commuter</option>
                                        @elseif ($person->type === "Student")
                                        <option value="Regular">Regular Commuter</option>
                                        <option value="Student" selected>Student Commuter</option>
                                        <option value="PWD">PWD Commuter</option>
                                        <option value="Senior">Senior Citizen Commuter</option>
                                        @elseif ($person->type === "PWD")
                                        <option value="Regular">Regular Commuter</option>
                                        <option value="Student">Student Commuter</option>
                                        <option value="PWD" selected>PWD Commuter</option>
                                        <option value="Senior">Senior Citizen Commuter</option>
                                        @else
                                        <option value="Regular">Regular Commuter</option>
                                        <option value="Student">Student Commuter</option>
                                        <option value="PWD">PWD Commuter</option>
                                        <option value="Senior" selected>Senior Citizen Commuter</option>
                                        @endif
                                    </select>
                                </td>
                                @break
                                @endif
                            @endforeach
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(Auth::user()->id === $user->id)
                                    Administrator
                                    <input hidden id="access{{ $user->id }}" value="1">
                                @else
                                    <select id="access{{ $user->id }}" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                                    name="access">
                                        @if ($user->access === 1)
                                        <option value="1" selected>Administrator</option>
                                        <option value="0">User</option>
                                        @else
                                        <option value="1">Administrator</option>
                                        <option value="0" selected>User</option>
                                        @endif
                                    </select>
                                @endif
                            </td>
                          
                            <td class="px-6 py-4 flex flex-row whitespace-nowrap">
                                <form method="POST" action="{{ route('update_users') }}">
                                    @csrf
                                    <button id="save{{ $user->id }}" type="submit" class="mt-2 mr-1 inline-flex items-center px-3 py-3  bg-gray-700 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-purple-900 active:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150" disabled>
                                        <svg class="h-4 w-4 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />  <polyline points="17 21 17 13 7 13 7 21" />  <polyline points="7 3 7 8 15 8" />
                                        </svg>
                                    </button>
                                    <input hidden id="new_type{{ $user->id }}" name="type" value="">
                                    <input hidden id="new_access{{ $user->id }}" name="access" value="">
                                    <input hidden name="id" value="{{ $user->id }}">
                                </form>

                                @if(Auth::user()->id === $user->id)
                                <button id="del{{ $user->id }}" class="mt-2 mr-1 inline-flex items-center px-3 py-3  bg-gray-700 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-purple-900 active:bg-gray-700 focus:outline-none focus:ring-indigo-500 focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150" disabled>
                                    <svg class="h-4 w-4 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="3 6 5 6 21 6" /> 
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </button>
                                @else
                                <button id="del{{ $user->id }}" onclick="deluser('{{ $user->id }}');" class="mt-2 ml-1 inline-flex items-center px-3 py-3 bg-purple-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-800 focus:bg-purple-900 active:bg-purple-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="h-4 w-4 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="3 6 5 6 21 6" /> 
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
    @if (isset($users) && isset($persons))
    @foreach ($users as $user)
        @foreach ($persons as $person)
            @if ($person->user_id === $user->id)
            <script>
                $('#type{{ $user->id }}, #access{{ $user->id }}').change(function() {
                    let access = $('#access{{ $user->id }}').val();
                    let type = $('#type{{ $user->id }}').val();

                    if ('{{ $user->access }}' != $('#access{{ $user->id }}').val() 
                    || '{{ $person->type }}' != $('#type{{ $user->id }}').val())
                    {
                        $('#save{{ $user->id }}').removeClass('bg-gray-700 hover:bg-gray-700 active:bg-gray-700');
                        $('#save{{ $user->id }}').addClass('bg-purple-950 hover:bg-purple-800 active:bg-purple-950');
                        $('#save{{ $user->id }}').prop('disabled', false);

                        $('#new_type{{ $user->id }}').val(type);
                        $('#new_access{{ $user->id }}').val(access);
                    }
                    
                    else 
                    {
                        $('#save{{ $user->id }}').removeClass('bg-purple-950 hover:bg-purple-800 active:bg-purple-950');
                        $('#save{{ $user->id }}').addClass('bg-gray-700 hover:bg-gray-700 active:bg-gray-700');
                        $('#save{{ $user->id }}').prop('disabled', true);

                        $('#new_type{{ $user->id }}').val("");
                        $('#new_access{{ $user->id }}').val("");
                    }
                });
            </script>
            @break
            @endif
        @endforeach
    @endforeach
    @endif
    <script>
        function deluser(user_id){
        if($('#blackscrn').css('display') === 'none' && user_id > 0){
                $('#blackscrn').fadeIn();
                $('#popup-delete').css("display", "flex").hide().fadeIn();
                $('#del_id').val(user_id);
            }

            else{
                $('#blackscrn').fadeOut();
                $('#popup-delete').fadeOut();
                $('#del_id').val('');
            }
    }
    </script>
</x-app-layout>
