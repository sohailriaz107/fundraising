<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\Campaign;
use App\Models\Donations;
use Illuminate\Http\Request;
use App\Models\Navigation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function RegisterForm()
    {
        return view('admin.register');
    }
    public function register(Request $request)
    {
        // Step 1: Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Step 2: Create a new user
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Step 3: Auto login after registration
        Auth::guard('admin')->login($admin);

        // Step 4: Redirect to dashboard
        return redirect('/dashboard')->with('success', 'Wellcome to dashboard');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }
     

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function dashboard()
    {
        $doners=Donations::count();
        $campaigns=Campaign::count();
        $completed_campaigns=Campaign::where('status','completed')->count();
        $pending_campaigns=Campaign::where('status','pending')->count();
        $users=User::count();
        return view('admin.dashboard',compact('doners','campaigns','completed_campaigns','pending_campaigns','users'));
    }
    public function navigation()
    {
        $navs = Navigation::all();
        return view('admin.nav', compact('navs'));
    }

    public function NavStore(Request $request)
    {
        $request->validate([
            'nav'   => 'required|string|max:255',
            'route' => 'required|string|max:255',
        ]);

        $nav = Navigation::create([
            'nav'   => $request->nav,
            'route' => $request->route,
        ]);

        if ($nav) {
            return redirect()->back()->with('success', 'Navigation added successfully!');
        } else {
            return redirect()->back()->with('error', 'Error saving navigation.');
        }
    }
    public function NavUpdate(Request $request, $id)
    {
        $request->validate([
            'nav'   => 'required|string|max:255',
            'route' => 'required|string|max:255',
        ]);

        $nav = Navigation::findOrFail($id);
        $nav->update([
            'nav'   => $request->nav,
            'route' => $request->route,
        ]);

        return redirect()->back()->with('success', 'Navigation updated successfully!');
    }

    public function NavDelete(Request $request, $id)
    {
        $nav = Navigation::find($id);

        if ($nav) {
            $data = $nav->delete();

            if ($data) {
                return redirect()->back()->with('success', 'Navigation deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to delete navigation.');
            }
        }

        return redirect()->back()->with('error', 'Navigation not found.');
    }
}
