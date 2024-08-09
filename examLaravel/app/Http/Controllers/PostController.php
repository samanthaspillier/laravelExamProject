<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
        

    public function index(): View
    {
        // Retrieve the latest 10 posts
        $posts = Post::latest()->paginate(12);

        return view('index', compact('posts'));
    }

    public function show($id): View
    {
        $post = Post::findOrFail($id);
        return view('content.showPost', compact('post'));
    }


}
