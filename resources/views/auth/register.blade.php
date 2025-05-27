<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="flex">
                <x-label for="fname" value="{{ __('First Name') }}" />
                <x-input id="fname" class="block mt-1 w-1/2" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="lname" />
                <x-label for="lname" value="{{ __('Last Name') }}" class="ml-5"/>
                <x-input id="lname" class="block mt-1 w-1/2" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="fname" />
            </div>

            <div class="mt-4">
                <x-label for="name" value="{{ __('Username') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="flex mt-5">
                <x-label for="age" value="{{ __('Age') }}" />
                <x-input id="age" class="block mt-1 w-1/4 ml-2" type="number" name="age" :value="old('age')" min="6" max="199" required/>
                <x-label for="gender" value="{{ __('Gender') }}" class="ml-5"/>
                    <select id="gender" class="block mt-1 ml-2 w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                     name="gender">
                        <option value="">Unspecified</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                        <option value="N">Not Applicable</option>
                    </select>
            </div>


            <div class="mt-4">
                <x-label for="type" value="{{ __('User Category') }}" />
                <select id="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm p-2"
                     name="type" required>
                        <option value="Regular">Regular Commuter</option>
                        <option value="Student">Student Commuter</option>
                        <option value="PWD">PWD Commuter</option>
                        <option value="Senior">Senior Citizen Commuter</option>
                    </select>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                
                <a href="{{ route('welcome') }}" class="ms-4 inline-flex items-center px-4 py-2 bg-purple-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-800 focus:bg-purple-900 active:bg-purple-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Return') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

