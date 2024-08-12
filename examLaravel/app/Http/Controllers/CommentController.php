<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

        return redirect()->route('post.show', $validated['post_id'])
        ->with('success', 'Comment created successfully');

    
}
}
