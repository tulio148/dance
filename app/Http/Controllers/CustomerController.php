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
        $client =  app(SquareClient::class);

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
        } else {
            $errors = $api_response->getErrors();
        }
        dd($result->getCustomer());
        dd($customer);




        // dd($errors);
    }
}
