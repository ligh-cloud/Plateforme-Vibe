<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FriendRequest extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'status'];

    public static function sendRequest($receiverId)
    {
        // Ensure a user is authenticated
        $senderId = Auth::id();
        if (!$senderId) {
            throw new \Exception('Aucun utilisateur connecté pour envoyer une demande d\'ami.');
        }

        // Check for existing friend request to prevent duplication
        $existingRequest = self::where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->whereIn('status', ['pending', 'accepted'])
            ->exists();

        if ($existingRequest) {
            return false;
        }

        // Insert the new friend request
        return DB::table('friend_requests')->insert([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending',
            'created_at' => now(),

        ]);
    }
}
