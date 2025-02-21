<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\UserSearchService;
use Illuminate\Http\Request;

class UserSearchController
{
    protected $userSearchService;
    public function __construct(UserSearchService $userSearchService)
    {
        $this->userSearchService = $userSearchService;
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        if(!$query){
            return response()->json(['message' => "please enter the ...."],400);
        }

        $users = $this->userSearchService->search($query);

        return view('user_search', compact('users'));


    }
}
