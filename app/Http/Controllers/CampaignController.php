<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CampaignController extends Controller
{
    //
    public function index()
    {
        $campaigns=Campaign::all();
        return view('admin.compaign', compact('campaigns'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'description'=> 'required|string|max:300',
            'gamount'  => 'required|numeric|min:1',
            'ramount'  => 'required|numeric|min:0',
            'sdate'    => 'required|date',
            'edate'    => 'required|date|after_or_equal:sdate',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Original file
            $file = $request->file('image');

            // Unique name (time + original extension)
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Move to public/campaigns folder
            $file->move(public_path('campaigns'), $filename);

            // Save relative path to DB
            $imagePath = 'campaigns/' . $filename;
        }


        // Save campaign
        Campaign::create([
            'campaign_name' => $request->name,
             'description' => $request->description,
            'goal_amount'   => $request->gamount,
            'raised_amount' => $request->ramount,
            'start_date'    => $request->sdate,
            'end_date'      => $request->edate,
            'status'        => 'pending',
            'image'         => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Campaign created successfully!');
    }
}
