<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Http\Requests\ProfileUpdateRequest;

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
     * Create a new admin user.
     */
    public function createAdmin(CreateAdminRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
        ]);

        return redirect()->back()->with('success', 'Admin user created successfully');

    }

    public function searchUsers(Request $request)
    {
        $searchTerm = $request->input('search');
    $users = User::where('name', 'like', '%' . $searchTerm . '%')
        ->orWhere('email', 'like', '%' . $searchTerm . '%')
        ->orderBy('name', 'asc')
        ->get();

    // Fetch other data that is required by the dashboard view
    $posts = Post::orderBy('published_at', 'desc')->take(5)->get(); // Latest posts for display
    $allPosts = Post::orderBy('published_at', 'desc')->get(); // All posts for dropdown
    $faqs = FAQ::all(); // Assuming you have FAQs data
    $allUsers = User::orderBy('name', 'asc')->get(); // All users for dropdown

    return view('admin.dashboard', [
        'posts' => $posts,
        'faqs' => $faqs,
        'users' => $users,
        'allPosts' => $allPosts,
        'allUsers' => $allUsers,
    ]);
    }

    public function editUser($id): View
    {
        $user = User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

    public function updateUser(ProfileUpdateRequest $request, $user): RedirectResponse
     {

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $path = $avatar->storeAs('public/images/avatars', $filename);

            // Save the avatar path in the database
            $user->avatar = 'images/avatars/' . $filename;
        }

        $user->update($request->all());

        return Redirect::route('admin.dashboard')->with('status', 'profile-updated');
   
       
     
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
            $validatedData['cover_image'] = $request->file('cover_image')->store('cover_images');
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
        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $request->file('cover_image')->store('cover_images');
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
