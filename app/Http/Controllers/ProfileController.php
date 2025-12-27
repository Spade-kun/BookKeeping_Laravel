<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     */
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ];

        // If user has a password (not Google OAuth only), require current password to change it
        if ($user->hasPassword()) {
            $rules['current_password'] = 'required_with:password';
            $rules['password'] = 'nullable|min:8|confirmed';
        } else {
            // Google OAuth users setting password for the first time
            $rules['password'] = 'nullable|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        // If user has a password, verify current password before allowing change
        if ($user->hasPassword() && $request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'The current password is incorrect.'
                ])->withInput();
            }
        }

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}
