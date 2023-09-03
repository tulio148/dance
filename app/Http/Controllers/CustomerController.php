<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Square\Models\CreateCustomerRequest;
use Square\SquareClient;

class CustomerController extends Controller
{

    public function createcustomer()
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
            dd($result);
        }
    }
}
