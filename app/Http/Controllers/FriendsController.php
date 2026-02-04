<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get accepted friends
        $acceptedFriends = $user->friends;
        
        // Get pending friend requests (received)
        $pendingRequests = $user->pending_requests;
        
        return view('friends.index', compact('acceptedFriends', 'pendingRequests'));
    }
}
