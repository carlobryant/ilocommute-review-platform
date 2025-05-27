<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'bossing',
            'email' => 'bossing@gmail.com',
            'password' => Hash::make('admin123'),
            'access' => '1',
        ]);

        Person::create([
            'user_id' => $admin->id,
            'fname' => 'Vic',
            'lname' => 'Sotto',
            'age' => '70',
            'gender' => 'M',
            'type' => 'Senior',
        ]);

        $user = User::create([
            'name' => 'wallybayola',
            'email' => 'wallybayola@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        Person::create([
            'user_id' => $user->id,
            'fname' => 'Wally',
            'lname' => 'Bayola',
            'age' => '52',
            'gender' => 'N',
            'type' => 'Regular',
        ]);
    }
}
