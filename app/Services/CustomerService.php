<?php

namespace App\Services;

use Square\SquareClient;
use App\Models\Customer;
use Square\Models\CreateCustomerRequest;

class CustomerService
{

    public function index($user)
    {
        $client = app(SquareClient::class);
        $api_response = $client->getCustomersApi()->retrieveCustomer($user->customer_id);
        if ($api_response->isSuccess()) {
            $result = $api_response->getResult();
            return $result;
        } else {
            $errors = $api_response->getErrors();
            dd($errors);
        }
    }

    public function store($user)
    {
        $client = app(SquareClient::class);
        $body = new CreateCustomerRequest();
        $body->setIdempotencyKey(uniqid());
        $body->setGivenName($user->name);
        $body->setEmailAddress($user->email);

        $api_response = $client->getCustomersApi()->createCustomer($body);

        if ($api_response->isSuccess()) {
            $result = $api_response->getResult();
            Customer::create(
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
            dd($errors);
        }
    }
}
