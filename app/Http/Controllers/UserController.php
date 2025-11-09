<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('login');
    }


    // Handle login request
    public function login(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Step 2: Attempt login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Step 3: Regenerate session for security
            $request->session()->regenerate();

            // Step 4: Redirect to dashboard or intended page
            return redirect('/')->with('success', 'Login successful!');
        }

        // Step 5: If login fails
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }


    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
    // Handle registration form submission
    public function register(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Step 2: Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Step 3: Auto login after registration
        Auth::login($user);

        // Step 4: Redirect to dashboard
        return redirect('/')->with('success', 'Account created successfully!');
    }
    public function showRegisterForm()
    {
        return view('register');
    }

    public function Profile()
    {

        $user = Auth::user();
        $user->load('donations');
        return view('fund.profile', compact('user'));
    }
    public function Update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            // Upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('upload/users'), $imageName);
            $user->image = 'upload/users/' . $imageName;
        }
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();
        return back()->with('success', 'Profile updated successfully!');
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validation
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
