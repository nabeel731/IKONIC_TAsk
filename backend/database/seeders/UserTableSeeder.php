<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'nabeel',
            'email' => 'nabeel53055@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'harris',
            'email' => 'harris123@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'ahamd',
            'email' => 'ahmiid@gmail.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
