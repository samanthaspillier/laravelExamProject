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

 

    /**
     * got to Post page
     */

     public function displayPost(Post $post): View
     {
         return view('content.post', compact('post'));  
     }


}
