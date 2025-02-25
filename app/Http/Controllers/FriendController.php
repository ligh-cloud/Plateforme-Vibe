<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function showUsers()
    {
        $friend = new Friend();
        $users = $friend->getAllUsers();

        return view('friends', compact('users'));
    }
    public function addFriends(User $user)
    {
        $connectedUser = Auth::user();

        if (!$connectedUser) {
            return response()->json(['error' => 'Vous devez être connecté pour ajouter un ami.'], 401);
        }

        if ($connectedUser->id === $user->id) {
            return response()->json(['error' => 'Vous ne pouvez pas vous envoyer une demande d\'ami.'], 422);
        }

        try {
            $success = FriendRequest::sendRequest($user->id);
            if (!$success) {
                return response()->json(['info' => 'Une demande d\'ami est déjà en cours ou acceptée.'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => 'Demande d\'ami envoyée avec succès !'], 200);
    }
    public function showFriends(){
            $userId = Auth::id();

            // Get all users who accepted the friend request
            $friends = User::whereHas('friendsAccepted', function ($query) use ($userId) {
                $query->where('receiver_id', $userId)
                    ->orWhere('sender_id', $userId);
            })->get();

            return view('friends.index', compact('friends'));

    }

}
