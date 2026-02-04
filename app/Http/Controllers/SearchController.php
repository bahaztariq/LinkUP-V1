<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('dashboard');
        }

        // Search Users
        $users = User::where('id', '!=', Auth::id())
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            })
            ->limit(20)
            ->get();

        // Search Posts
        $posts = Post::with(['user', 'comments', 'reactions'])
            ->where('content', 'like', "%{$query}%")
            ->latest()
            ->get();

        return view('search.results', compact('users', 'posts', 'query'));
    }
}