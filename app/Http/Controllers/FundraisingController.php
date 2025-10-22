<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Campaign;
use App\Models\Donations;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;
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
    return view('fund.campaigns', compact('funds', 'totalDonated'));
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
    $doners = Donations::with('campaign')->get();
    return view('fund.donate', compact('doners'));
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

    Stripe::setApiKey(config('services.stripe.secret'));

    try {
        $charge = \Stripe\Charge::create([
            "amount" => $request->amount * 100, // Stripe requires amount in cents
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from Sohail Riaz",
        ]);

        // ✅ Save donation only if Stripe payment succeeds
        $fund = new \App\Models\Donations();
        $fund->amount = $request->amount;
        $fund->user_id = Auth::id(); // Logged-in user ID
        $fund->campaign_id = $request->campaign_id;
        $fund->donor_name = auth()->user()->name ?? 'Anonymous';
        $fund->transaction_id = $charge->id; // optional: store Stripe transaction ID
        $fund->status = $charge->status; // optional: store payment status
        $fund->save();

        return back()->with('success', 'Payment successful! Thank you for your donation.');
    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}

}
