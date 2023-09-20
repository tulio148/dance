<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StudentService;
use App\Http\Controllers\Controller;
use Square\Models\Money;
use Square\SquareClient;
use Square\Models\CreatePaymentRequest;

class StudentController extends Controller
{
    public function store()
    {
        $user = auth()->user();
        if (!$user->student) {
            app(StudentService::class)->store($user);
            return redirect()->route('dashboard');
        }
    }



    public function createpayment(Request $request)
    {
        // dd($request->all());

        $token = $request->input('token');
        // dd($token);
        $user = auth()->user();
        $client = app(SquareClient::class);

        $amount_money = new Money();
        $amount_money->setAmount(5000);
        $amount_money->setCurrency('AUD');
        $idempotency_key = uniqid();

        $body = new CreatePaymentRequest($token, $idempotency_key);
        $body->setAmountMoney($amount_money);
        $body->setAutocomplete(true);
        $body->setCustomerId($user->student_id);
        $body->setOrderId('oJTJnk5fDVG9e9icl7csjQkr8RJZY');
        $body->setLocationId('LQ8X13Y7ZQ55H');
        $body->setAcceptPartialAuthorization(false);

        $api_response = $client->getPaymentsApi()->createPayment($body);
        if ($api_response->isSuccess()) {
            $result = $api_response->getResult();
            dd($result);
        } else {
            $errors = $api_response->getErrors();
            dd($errors);
        }

        return redirect()->route('dashboard');
    }
}
