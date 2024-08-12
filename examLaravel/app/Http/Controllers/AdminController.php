<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;

use App\Models\User;
use App\Models\FAQ;
use App\Models\Post;
use App\Models\ContactMessage;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;




use App\Mail\ContactMessageAnswered;


class AdminController extends Controller
{
    public function __construct()
    {
        // Apply the 'admin' middleware to all methods
        $this->middleware('admin');
    }

    
    public function dashboard(): View
    {
        $posts = Post::orderBy('published_at', 'desc')->take(5)->get(); //latest posts for display
        $allPosts = Post::orderBy('published_at', 'desc')->get(); //all posts for dropdown
        $faqs=FAQ::all();
        $users = User::orderBy('created_at', 'desc')->take(10)->get(); // lastest created users for display
        $allUsers = User::orderBy('name', 'asc')->get(); // All users for dropdown
        $unansweredMessages = ContactMessage::where('answered', false)->get();
        
        return view('admin.dashboard', compact(['posts', 'faqs', 'users', 'allPosts', 'allUsers', 'unansweredMessages']));
    }

    /**
     * go to the new user form
     */
    public function newUser(): View
    {
        return view('admin.newUser');
    }
    /**
     * Create a new user functions.
     */

    public function createUser(Request $request): RedirectResponse
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'birthday' => 'nullable|date',
                'bio' => 'nullable|string',
                'avatar' => 'nullable|image|max:2048',
                'role' => 'required|in:admin,user'
            ]);
        
            $user = new User($validated);
            if ($request->hasFile('avatar')) {
                $user->avatar = $request->file('avatar')->store('avatars', 'public');
            }
            $user->password = Hash::make('defaultPassword'); // Set a default password or handle differently
            $user->save();
        
            return redirect()->route('admin.dashboard')->with('success', 'User created successfully');
        }
     

    public function searchUsers(Request $request)
    {
        $searchTerm = $request->input('search');
        $searchResults = User::where('name', 'like', '%' . $searchTerm . '%')
                            ->orWhere('email', 'like', '%' . $searchTerm . '%')
                            ->orderBy('name', 'asc')
                            ->get();

  

        $posts = Post::orderBy('published_at', 'desc')->take(5)->get(); //latest posts for display
        $allPosts = Post::orderBy('published_at', 'desc')->get(); //all posts for dropdown
        $faqs=FAQ::all();
        $users = User::orderBy('created_at', 'desc')->take(10)->get(); // lastest created users for display
        $allUsers = User::orderBy('name', 'asc')->get(); // All users for dropdown
        $unansweredMessages = ContactMessage::where('answered', false)->get();
    
        return view('admin.dashboard', compact(['posts', 'faqs', 'users', 'allPosts', 'allUsers', 'unansweredMessages', 'searchResults']));
    
    
    }

    public function editUser($id): View
    {
        $user = User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

   


     /**
      * FAQ related ADMIN methods
      */
    public function createFaq(): View
    {
        return view('admin.editFaq', ['faq' => new FAQ]);
    }

    public function storeFaq(Request $request): RedirectResponse
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        FAQ::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        return redirect()->back()->with('success', 'FAQ created successfully');
    }
    public function editFaq($id): View
    {
        $faq = FAQ::findOrFail($id);
        return view('admin.editFaq', compact('faq'));
    }

    public function updateFaq(Request $request, $id): RedirectResponse
    {
    $request->validate([
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
    ]);

    $faq = FAQ::findOrFail($id);
    $faq->update([
        'question' => $request->input('question'),
        'answer' => $request->input('answer'),
    ]);

    return redirect()->back()->with('success', 'FAQ updated successfully');
    }

    public function deleteFaq(Request $request, $id): RedirectResponse
    {
        // Find the post to delete
        $faq = FAQ::findOrFail($id);

        // Perform the deletion
        $faq->delete();

        // Redirect back with a success message
        return redirect()->route('admin.dashboard')->with('status', 'faq-deleted');
    }


    /**
     * Post related ADMIN methods
     */
    public function createPost()
    {
        return view('admin.editPost', ['post' => new Post]);
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
        return view('admin.editPost', compact('post'));
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

    /**
     * message related admin methods
     */
    public function answerMessageForm($id): View
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.answerMessage', compact('message'));
    }
    
    public function submitAnswer(Request $request, $id): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'answer' => 'required|string',
        ]);
    
        // Find the contact message
        $message = ContactMessage::findOrFail($id);
        $answer = $request->input('answer');
      

    
        // Send the answer via email
        Mail::to($message->email)->send(new ContactMessageAnswered($message, $answer));
        
        // Update the message to mark it as answered in the database
        $message->update([
            'answered' => true,
            'answer' => $answer,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('admin.dashboard')->with('status', 'Message answered and email sent successfully');
    }
    
    



     
}
?>
