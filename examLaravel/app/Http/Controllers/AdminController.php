<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateUserRoleRequest;



use App\Models\User;
use App\Models\FAQ;

use App\Http\Middleware\AdminMiddleware;



use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        // Apply the 'admin' middleware to all methods
        $this->middleware('admin');
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


     public function updateRole(UpdateUserRoleRequest  $request, $id): RedirectResponse
     {
        // Validate the request
        $validated = $request->validated();

        $user = User::find($id);
        if ($user) {
            $user->is_admin = $validated['is_admin'];
            $user->save();
    
            return redirect()->back()->with('success', 'Role updated successfully');
        } else {
            abort(404, 'User not found');

        }
     
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
     
}
?>
