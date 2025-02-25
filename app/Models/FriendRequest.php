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
    public static function getPendingRequests()
    {
        $userId = Auth::id();

        // Get all pending friend requests where current user is the receiver
        return self::where('receiver_id', $userId)
            ->where('status', 'pending')
            ->with('sender') // Eager load the sender's info
            ->get();
    }


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function friendRequestsReceived()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    public function friendRequests()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id')
            ->orWhere('receiver_id', $this->id);
    }

    public function friendsAccepted()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id')
            ->where('status', 'accepted')
            ->orWhere(function ($query) {
                $query->where('receiver_id', $this->id)
                    ->where('status', 'accepted');
            });
    }
    public function getFriends(){

        $friends = $this->hasMany(FriendRequest::class, 'sender_id')
            ->where('status', 'accepted')
            ->orWhere(function ($query) {
                $query->where('receiver_id', Auth::id())
                    ->where('status', 'accepted');
            })->get();
        return $friends;
    }
}

