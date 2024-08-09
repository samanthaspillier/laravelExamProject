<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * got to "new comment" page
     */

     public function newComment(Post $post): View
     {
         return view('content.newComment', compact('post'));  
     }

    /**
     * Create a new comment.
     */
    public function storeComment(CreateCommentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Comment::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'post_id' => $validated['post_id'],
        ]);

        return redirect()->back()->with('success', 'Comment created successfully');
    }

    
}
