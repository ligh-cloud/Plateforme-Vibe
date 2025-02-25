<?php

namespace Database\Factories;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class FriendRequestFactory extends Factory
{
    protected $model = FriendRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::inRandomOrder()->first()->id,
            'receiver_id' => User::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['accepted', 'refused', 'pending']),
            'created_at' => now(),
        ];
    }
}
