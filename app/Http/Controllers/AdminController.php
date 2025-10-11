<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Navigation;

class AdminController extends Controller
{
    //

    public function dashboard()
    {
        return view('admin.dashboard');
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
