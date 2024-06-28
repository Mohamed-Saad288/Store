<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name' => 'Mohamed Saad',
            'email' => 'mosaad2888@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '2656532565'
        ]);
        DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'mosaad28888@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '26565325654'
        ]);
    }
}
