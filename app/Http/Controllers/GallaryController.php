<?php

namespace App\Http\Controllers;

use App\Models\Gallary;
use Illuminate\Http\Request;

class GallaryController extends Controller
{
    //
    public function index()
    {
        $gallary = Gallary::all();
        return view('admin.gallary', compact('gallary'));
    }
    public function store(Request $request)
    {
        $request->validate([

            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $gallery = Gallary::findOrFail($id); // Find specific record

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($gallery->image && file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }

            // Upload new image
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('gallary'), $filename);
            $gallery->image = 'gallary/' . $filename;
        }

        $gallery->save(); // Update record

        return redirect()->back()->with('success', 'Image updated successfully!');
    }
    public function destroy(Request $request,$id){
        $img=Gallary::find($id);
        if($img){
            $img->delete();
         return redirect()->back()->with('success',"Image deleted successfully");
        }
        else{
         return redirect()->back()->with('error',"Error to delete image");
        }
    }
}
