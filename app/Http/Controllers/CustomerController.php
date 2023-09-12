<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Square\Models\Money;
use Square\SquareClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Square\Models\CreatePaymentRequest;
use Square\Models\CreateCustomerRequest;

class CustomerController extends Controller
{

    public function createcustomer()
    {
        $user = auth()->user();
        $client = app(SquareClient::class);
        // dd($client);

        if (!$user->customer_id) {

            $body = new CreateCustomerRequest();
            $body->setIdempotencyKey(uniqid());
            $body->setGivenName(auth()->user()->name);
            $body->setEmailAddress(auth()->user()->email);

            $api_response = $client->getCustomersApi()->createCustomer($body);
            if ($api_response->isSuccess()) {
                $result = $api_response->getResult();
                $customer = Customer::updateOrCreate(
                    ["email" => $result->getCustomer()->getEmailAddress()],
                    [
                        'id' => $result->getCustomer()->getId(),
                        'name' => $result->getCustomer()->getGivenName(),
                        'email' => $result->getCustomer()->getEmailAddress()
                    ]
                );
                $user->customer_id = $result->getCustomer()->getId();
                
               // @php intel-disable-next-line
                $user->save();
            } else {
                $errors = $api_response->getErrors();
            }
            return redirect()->route('dashboard');
        } else {
            $api_response = $client->getCustomersApi()->retrieveCustomer($user->customer_id);

            if ($api_response->isSuccess()) {
                $result = $api_response->getResult();
            } else {
                $errors = $api_response->getErrors();
            }
        }
    }

    public function createpayment(Request $request)
    {
        $user = auth()->user();
        $client = app(SquareClient::class);

        if (!$user->customer_id) {
            $body = new CreateCustomerRequest();
            $body->setIdempotencyKey(uniqid());
            $body->setGivenName(auth()->user()->name);
            $body->setEmailAddress(auth()->user()->email);

            $api_response = $client->getCustomersApi()->createCustomer($body);
            if ($api_response->isSuccess()) {
                $result = $api_response->getResult();
                $customer = Customer::updateOrCreate(
                    ["email" => $result->getCustomer()->getEmailAddress()],
                    [
                        'id' => $result->getCustomer()->getId(),
                        'name' => $result->getCustomer()->getGivenName(),
                        'email' => $result->getCustomer()->getEmailAddress()
                    ]
                );
                $user->customer_id = $result->getCustomer()->getId();
                $user->save();

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

            } else {
                $errors = $api_response->getErrors();
            }
            return redirect()->route('dashboard');
        } else {
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
      
}
