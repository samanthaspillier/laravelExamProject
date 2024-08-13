<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;

use App\Models\User;
use App\Models\FAQ;
use App\Models\Post;
use App\Models\ContactMessage;
use App\Models\Comment;
use App\Models\FaqCategory;

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
        $unansweredMessages = ContactMessage::where('answered', false)->get(); //only unanswered messages
        $categories = FaqCategory::all(); //all available categories
       
        
        return view('admin.dashboard', compact(['posts', 'faqs', 'users', 'allPosts', 'allUsers', 'unansweredMessages', 'categories']));
    }

    /**
     * user related admin methods
     */
    public function newUser(): View
    {
        return view('admin.users.newUser');
    }
   

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

            $user->password = Hash::make('Password!123'); // default password
            $user->is_admin = $validated['role'] === 'admin'; //put is_admin to true if role is admin

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
    
         $categories = FaqCategory::all(); //all available categories
        
        return view('admin.dashboard', compact(['posts', 'faqs', 'users', 'allPosts', 'allUsers', 'unansweredMessages', 'categories', 'searchResults']));    
    
    }

    public function editUser($id): View
    {
        $user = User::findOrFail($id);
        return view('admin.users.editUser', compact('user'));
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
