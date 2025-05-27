<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Person;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Authenticatable
    {   
        Validator::make($input, [
            'fname' => ['required', 'string', 'max:40'],
            'lname' => ['required', 'string', 'max:40'],
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer'],
            'type' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Person::create([
            'user_id' => $user->id,
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'age' => $input['age'],
            'gender' => $input['gender'],
            'type' => $input['type'],
        ]);

        return $user;

    }
}
