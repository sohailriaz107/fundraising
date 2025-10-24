<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Donations;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    //
    public function about()
    {
        $about = About::all();
        return view('admin.about', compact('about'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'history' => 'required|string|max:255'

        ]);
        //   dd($request->all());
        $about = About::create([
            'title' => $request->title,
            'history' => $request->history,
        ]);
        if ($about) {
            return redirect()->back()->with('success', 'About is Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Error While Creating about');
        }
    }

    public function Update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'history' => 'required|string|max:255'

        ]);
          dd($request->all());
        $about = About::find($id);
         $about->Update([
            'title' => $request->title,
            'history' => $request->history,
        ]);
        if ($about) {
            return redirect()->back()->with('success', 'About is edited  Successfully');
        } else {
            return redirect()->back()->with('error', 'Error While Creating about');
        }
    }

    public function destroy(Request $request,$id){
        $about=About::find($id);
        if($about){
          $about->delete();
          return redirect()->back()->with('success','About deleted');
        }
        else{
              return redirect()->back()->with('error','Find error');
        }
    }

    // doners
    public function Doners(){
        $doners=Donations::with('campaign')->get();
        return view('admin.doners',compact('doners'));
    }
    public function Deleted(Request $request,$id){
        $doner=Donations::find($id);
        if($doner){
            $doner->delete();
            return redirect()->back()->with('success','doners deleted');
        }
        else{
            return redirect()->back()->with('error','error to deleted');
        }
    }
}
