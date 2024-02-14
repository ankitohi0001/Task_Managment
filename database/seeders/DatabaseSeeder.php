<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'password' => Hash::make('secret')
        ]);
        //Status fields
        Status::create([
            'name' => 'To Do',
        ]);
        Status::create([
            'name' => 'Progress', 
        ]);
        Status::create([
            'name' => 'Testing', 
        ]);
        Status::create([
            'name' => 'Review', 
        ]);
        Status::create([
            'name' => 'Done', 
        ]);
    }
}
