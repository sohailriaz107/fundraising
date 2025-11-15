<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    //
    public function Teams(){
        $teams=Teams::all();
        return view('admin.teams',compact('teams'));
    }
    public function store(Request $request){
        $request->validate([
           'name'=>'required|string|max:255',
           'role'=>'required|string|max:255',
           'description'=>'required',
           'image'=>'required|image|mimes:png,jpg,webp,jpeg,svg|max:1048',
        ]);

        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=time() . '.' . $file->getClientOriginalExtension();
            $path='upload/teams/';
            $file->move(public_path($path),$filename);
        }


         Teams::create([
        'name'  => $request->name,
        'role'  => $request->role,
        'description'  => $request->description,
        'image' => $filename ?? null,
    ]);

    return redirect()->back()->with('success', 'Team member created successfully!');
    }
     
    public function Update(Request $request,$id){
         $request->validate([
           'name'=>'required|string|max:255',
           'role'=>'required|string|max:255',
           'description'=>'required',
           
        ]);
        $member=Teams::findOrFail($id);
          $member->name = $request->name;
         $member->role = $request->role;
          $member->description = $request->description;
         if($request->hasFile('image')){
            if ($member->image && file_exists(public_path($member->image))) {
                unlink(public_path($member->image));
            }

            $file=$request->file('image');
            $filename=time() . '.' . $file->getClientOriginalExtension();
            $path='upload/teams/';
            $file->move(public_path($path),$filename);
        }

        $member->save();
        return redirect()->back()->with('success','Member updated successfully');

    }
    public function destroy(Request $request,$id){
        $member=Teams::find($id);
        if($member){
            $member->delete();
            return redirect()->back()->with('success','member deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Erroe while deleting member');
        }
    }
}
