<?php




namespace App\Http\Controllers\Services;

use App\Models\User;



class UserSearchService
{
    public function search($query)
    {
        return User::where("name", "LIKE", "%{$query}%")
            ->orWhere("email", "LIKE", "%{$query}%")
            ->get();
    }
}

