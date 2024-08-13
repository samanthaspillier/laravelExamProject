<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PostController extends Controller
{
    public function __construct()
    {
        // Apply the 'admin' middleware to all methods
        $this->middleware('admin')->except(['index', 'displayPost']);
    }
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

      /**
     * Post related ADMIN methods
     */
    public function createPost()
    {
        return view('admin.posts.editPost', ['post' => new Post]);
    }

    public function storePost(Request $request)
    {
        // Validate and store the new post
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            \Log::info('File is being uploaded to: ' . public_path('images/covers'));
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName(); // Create a unique filename
            // Move the file to the public directory
            $file->move(public_path('images/covers'), $filename);
            $validatedData['cover_image'] = 'images/covers/' . $filename;
        }

        

      

        Post::create($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Post created successfully.');
    }

    public function editPost($id)
    {
        // Find the post by ID and show the edit form
        $post = Post::findOrFail($id);
        return view('admin.posts.editPost', compact('post'));
    }

    public function updatePost(Request $request, $id)
    {
        // Validate and update the existing post
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the post and update its attributes
        $post = Post::findOrFail($id);

        // Handle file upload
          // Handle file upload
          if ($request->hasFile('cover_image')) {
            \Log::info('File is being uploaded to: ' . public_path('images/covers'));
            $file = $request->file('cover_image');
            $filename = time() . '_' . $file->getClientOriginalName(); // Create a unique filename
            // Move the file to the public directory
            $file->move(public_path('images/covers'), $filename);
            $validatedData['cover_image'] = 'images/covers/' . $filename;
        }

        $post->update($validatedData);

        return redirect()->route('admin.dashboard')->with('success', 'Post updated successfully.');
    }

    public function deletePost(Request $request, $postid): RedirectResponse
    {
        // Find the post to delete
        $post = Post::findOrFail($postid);

        // Perform the deletion
        $post->delete();

        // Redirect back with a success message
        return redirect()->route('admin.dashboard')->with('status', 'post-deleted');
    }


}
