<?php

namespace App\Http\Controllers;

use App\Models\Gallary;
use Illuminate\Http\Request;

class GallaryController extends Controller
{
    //
    public function index()
    {
        return view('admin.gallary');
    }
    public function store(Request $request)
    {
        $request->validate([

            'image'=> 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Original file
            $file = $request->file('image');
            // Unique name (time + original extension)
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Move to public/campaigns folder
            $file->move(public_path('gallary'), $filename);
            // Save relative path to DB
            $imagePath = 'gallary/' . $filename;
        }
        // Save campaign
        Gallary::create([

            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Gallary Image Uploaded!');
    }
}
