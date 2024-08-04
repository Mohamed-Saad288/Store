<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


//        Store::factory(5)->create();
//        Category::factory(10)->create();
//        Product::factory(100)->create();
//        User::create([
//            'name' => 'Mohamed Saad',
//            'email' => 'mosaad2888@gmial.com',
//            'password' => Hash::make('password'),
//        ]);
//        Admin::factory('3')->create();
       // $this->call(UserSeeder::class);



        Admin::create([
            'name' => 'Store Owner',
            'email' => 'store@gmail.com',
            'password' => Hash::make('password'),
            'username'=> 'store',
            'phone_number' => '01044569654',
            'super_admin' => 0
        ]);
    }
}
