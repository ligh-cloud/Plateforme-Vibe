<?php

namespace Database\Seeders;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class FriendRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there are at least 10 users
        if (User::count() < 10) {
            User::factory(10)->create();
        }

        // Generate 20 friend requests
        FriendRequest::factory(20)->create();
    }
}
