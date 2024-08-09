<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PostController extends Controller
{
    
   /**
    * Show the index page.
    */       

    public function index(): View
    {
        $posts = Post::latest()->paginate(12);

        return view('index', compact('posts'));
    }

 

    /**
     * go to Post page
     */

     public function displayPost(Post $post): View
     {
         return view('content.post', compact('post'));  
     }


}
