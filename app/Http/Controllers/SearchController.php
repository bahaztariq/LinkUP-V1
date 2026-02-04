<?php


namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;




class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $users = collect();
        $posts = collect();

        if ($query) {
            $users = \App\Models\User::where('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->get();

            $posts = \App\Models\Post::where('content', 'like', "%{$query}%")
                ->with('user')
                ->latest()
                ->get();
        }

        return view('search.results', compact('users', 'posts', 'query'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}