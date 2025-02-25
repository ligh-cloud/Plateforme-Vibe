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
    public function showFriends()
    {
        $user = Auth::user();
        $friends = $user->getFriends();

        return view('friends.index', compact('friends'));
    }
    public function showFriendProfile(User $user) {

        $authUser = Auth::user();
        $isFriend = $authUser->friendsAccepted()->where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)->exists();
        return view('friends.profile', compact('user', 'isFriend'));
    }

    public function showPendingRequests()
    {
        $pendingRequests = FriendRequest::getPendingRequests();
        return view('friends.pending-requests', compact('pendingRequests'));
    }

    public function acceptRequest($requestId)
    {
        $request = FriendRequest::findOrFail($requestId);

        // Verify that the authenticated user is the receiver of this request
        if (Auth::id() != $request->receiver_id) {
            return redirect()->back()->with('error', 'Non autorisé à accepter cette demande.');
        }

        // Update the request status
        $request->status = 'accepted';
        $request->save();

        return redirect()->back()->with('success', 'Demande d\'ami acceptée!');
    }

    public function rejectRequest($requestId)
    {
        $request = FriendRequest::findOrFail($requestId);

        // Verify that the authenticated user is the receiver of this request
        if (Auth::id() != $request->receiver_id) {
            return redirect()->back()->with('error', 'Non autorisé à refuser cette demande.');
        }


        $request->status = 'refused';
        $request->save();

        return redirect()->back()->with('success', 'Demande d\'ami refusée.');
    }

}
