<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            // Update basic user information
            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('phone')) {
                $updateData['phone'] = $request->phone;
            }

            // Update password if provided
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            return redirect()->back()->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            \Log::error('User profile update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update profile: ' . $e->getMessage())
                ->withInput();
        }
    }
}
