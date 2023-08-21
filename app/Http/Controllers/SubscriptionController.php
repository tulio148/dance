<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        // dd(auth()->user()->createSetupIntent()->client_secret);
        return view('subscribe', ['intent' => auth()->user()->createSetupIntent()]);
    }

    public function store(Request $request)
    {
        auth()->user()->newSubscription('subscription', $request->plan)->create($request->paymentMethod);

        return redirect('/dashboard');
    }
}
