<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'like', "%{$query}%")->get();
        $posts = Post::where('title', 'like', "%{$query}%")->get();

        return view('search.results', compact('users', 'posts'));
    }
}