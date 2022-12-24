<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'karim mohamed',
            'email' => 'k@test.com',
            'email_verified_at' => now(),
            'is_admin' => '1',
            'password' => Hash::make('123456789'), // to test 
            'remember_token' => Str::random(10),
            
        ]);
    }
    
}
