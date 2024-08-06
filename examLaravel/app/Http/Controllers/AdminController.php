<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateUserRoleRequest;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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
     
}
?>
