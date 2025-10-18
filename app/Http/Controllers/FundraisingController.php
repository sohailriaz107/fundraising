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
    $funds = Campaign::all();
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
    $funds = Campaign::findOrFail($id);
    return view('fund.campaigns', compact('funds'));
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
    ]);
    $fund = new Donations();
    $fund->amount = $request->amount;
    $fund->user_id = Auth::id(); // if user is logged in
    $fund->donor_name = auth()->user()->name ?? 'Anonymous';
    $fund->save();
    return redirect()->back()->with('success', 'Amount sent successfully!');
  }
}
