<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserUpdateController extends Controller
{
    public function update(Request $request)
    {
        if (!$request->isMethod('put')) {
            return back()->withErrors(['error' => 'Méthode non autorisée']);
        }


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();


        if ($request->hasFile('avatar')) {
            // Supprimer l'ancienne image si elle existe
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            // Enregistrer la nouvelle image
            $photoName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('public/avatars', $photoName);

            // Mettre à jour l'utilisateur avec l'image
            $user->avatar = $photoName;
        }

        // ✅ 3️⃣ Mettre à jour les autres données
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio; // Explicitly assign bio
        $user->save();

        return back()->with('success', 'Profil mis à jour avec succès !');
    }
}
