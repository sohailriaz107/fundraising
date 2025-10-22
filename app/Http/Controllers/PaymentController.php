<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Exception;
class PaymentController extends Controller
{
    //
    public function index()
    {
        return view('payment');
    }

    public function store(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                "amount" => $request->amount * 100, // in cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from sohail riaz",
            ]);

            return back()->with('success', 'Payment successful!');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
