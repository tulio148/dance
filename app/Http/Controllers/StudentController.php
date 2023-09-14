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
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $student = auth()->user()->student;
        if ($student) {
            $square_student = $this->studentService->index($student);
            dd($square_student);
        } else {
            dd("no");
        }
        //     return view('test', compact('student'));
    }

    public function store()
    {
        $user = auth()->user();

        if (!$user->student_id) {
            $this->studentService->store($user);
            return redirect()->route('dashboard');
        }
    }


    public function createpayment(Request $request)
    {
        $user = auth()->user();
        $client = app(SquareClient::class);

        $token = $request->input('token');
        $amount_money = new Money();
        $amount_money->setAmount(100);
        $amount_money->setCurrency('AUD');
        $idempotency_key = uniqid();

        $body = new CreatePaymentRequest($token, $idempotency_key);
        $body->setAmountMoney($amount_money);
        $body->setAutocomplete(true);
        $body->setCustomerId($user->customer_id);
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
