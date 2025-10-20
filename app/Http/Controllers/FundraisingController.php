<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Campaign;
use App\Models\Donations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundraisingController extends Controller
{
  //
  public function home()
  {
    $funds = Campaign::with('donations')->get();
    
    return view('fund.index', compact('funds'));
  }
  public function about()
  {
    $about = About::all();
    return view('fund.about', compact('about'));
  }
  public function blog()
  {
    return view('fund.blog');
  }
  public function DoCompaigns($id)
  {
    $funds = Campaign::with('donations')->findOrFail($id);

      $totalDonated = $funds->donations->sum('amount');
    return view('fund.campaigns', compact('funds','totalDonated'));
  }
  public function contact()
  {
    return view('fund.contact');
  }
  public function gallary()
  {
    return view('fund.gallery');
  }
  public function How_Works()
  {
    return view('fund.how-it-works');
  }
  public function donate()
  {
    return view('fund.donate');
  }
  public function Campaign()
  {
    return view('fund.campaign');
  }
  public function Donation(Request $request)
  {
    $request->validate([
      'amount' => 'required|numeric|max:999999.99',
      'campaign_id' => 'nullable|exists:campaigns,id', 
    ]);
    $fund = new Donations();
    $fund->amount = $request->amount;
    $fund->user_id = Auth::id(); // if user is logged in
     $fund->campaign_id = $request->campaign_id; // ✅ save campaign ID
    $fund->donor_name = auth()->user()->name ?? 'Anonymous';
    $fund->save();
    return redirect()->back()->with('success', 'Amount sent successfully!');
  }
}
