<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rules\Password;

use Illuminate\View\View;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
    
        return view('profile.edit', [
            'user' => $user,
            'isAdmin' => $user->is_admin,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, $toupdate): RedirectResponse
    {
        $userToUpdate = User::findOrFail($toupdate);
        $requestor = $request->user();
        // Debugging: dump user ID to make sure it's correct

        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userToUpdate->id, // Ensure the email is unique but exclude this user's ID
            'birthday' => 'nullable|date',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
            'role' => 'in:admin,user', // Validate the role field if it exists
        ]);
    
        // Update the user's data
        $userToUpdate->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'birthday' => $validated['birthday'],
            'bio' => $validated['bio'],
        ]);
        
        // Only update the role if the current user is an admin and the role input is present
         if ($requestor->isAdmin() && $request->has('role')) {
        $userToUpdate->update([
            'is_admin' => $validated['role'] === 'admin' ? true : false,
        ]);



        }

            // Handle avatar upload if present
            if ($request->hasFile('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
                $userToUpdate->update(['avatar' => $path]);
            }

            return redirect()->back()->with('status', 'profile-updated');
        }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request, $todelete): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
    
        $user = $request->user();
        $userToDelete = User::findOrFail($todelete);
    
        // Additional checks if needed
        if ($userToDelete->id === $user->id) {
            // Handle account deletion for the authenticated user
            $userToDelete->delete();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return Redirect::to('/')->with('status', 'account-deleted');
        } else {
            // Handle deletion of other users
            $userToDelete->delete();
            return Redirect::route('admin.dashboard')->with('status', 'user-deleted');
        }
       
    }
   
    

    /**
     * Display the user's profile.
     */
    public function show(User $user)
    {
        return view('profile.profile', compact('user'));
    }

}
