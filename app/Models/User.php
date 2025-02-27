<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function friendsAccepted()
    {
        // This is the correct way to define this relationship
        return FriendRequest::where(function ($query) {
            $query->where('sender_id', $this->id)
                ->where('status', 'accepted');
        })->orWhere(function ($query) {
            $query->where('receiver_id', $this->id)
                ->where('status', 'accepted');
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // In App\Models\User

    public function getFriends()
    {
        // Get IDs of users who are friends with the  user
        $friendRequests = FriendRequest::where('status', 'accepted')
            ->where(function ($query) {
                $query->where('sender_id', $this->id)
                    ->orWhere('receiver_id', $this->id);
            })
            ->get();

        // Collect all user IDs that are friends with the  user
        $friendIds = collect();

        foreach ($friendRequests as $request) {
            if ($request->sender_id == $this->id) {
                $friendIds->push($request->receiver_id);
            } else {
                $friendIds->push($request->sender_id);
            }
        }
        dd($friendIds);

        // Find all users with these IDs
        return User::whereIn('id', $friendIds)->get();
    }
    public function friendRequests()
    {

        return FriendRequest::where('sender_id', $this->id)
            ->orWhere('receiver_id', $this->id);
    }
}
