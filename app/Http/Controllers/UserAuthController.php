<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        session()->flash('tab', 'user');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('user.bookings.index'));
        }

        return back()->withErrors([
            'email' => __('The provided credentials do not match our records.'),
        ])->withInput($request->only('email'))->with('tab', 'user');
    }

    public function showRegisterForm()
    {
        $companies = Company::where('is_active', true)->get();
        return view('auth.user-register', compact('companies'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'company_id' => 'required|exists:companies,id',
            'role' => 'required|in:user,employee,manager',
            'department' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'company_id' => $request->company_id,
            'role' => $request->role,
            'department' => $request->department,
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect(route('user.bookings.index'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}


