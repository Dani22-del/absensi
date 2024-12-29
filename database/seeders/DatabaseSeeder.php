<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([  
            [    
                'name' => 'Avif',
                'email' => 'mangupura12@gmail.com',
                'password' => Hash::make('avif12'),
                'level_user' => 'admin'
            ]
        ]);
    }
}
