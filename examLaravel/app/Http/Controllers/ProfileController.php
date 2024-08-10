<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = User::findOrFail($id);

    // Validate the input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'birthday' => 'nullable|date',
        'avatar' => 'nullable|image|max:2048',
        'role' => 'in:admin,user' // Validate the role field
    ]);

    // Update the user's data
    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'birthday' => $validated['birthday'],
        'bio' => $request->input('bio'),
        'role' => $validated['role'] === 'admin' ? 1 : 0, // Assuming role is stored as an integer
    ]);

    // Handle avatar upload if present
    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);
    }

    return redirect()->route('profile.edit', $user->id)->with('status', 'profile-updated');
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
