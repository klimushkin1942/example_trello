<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'klimushkin',
            'email' => 'muhammed1942ali@gmail.com',
            'password' => Hash::make('klim1942')
        ]);
    }
}
