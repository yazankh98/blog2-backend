<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\NullableType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'=>'yazan',
            'email'=>'yazan.kh.anam@gmail.com',
            'password' =>Hash::make('123123123'),
            'is_admin'=> true,
            'image'=>'Null',
            'is_block'=>false
        ]);
        
    }
}
