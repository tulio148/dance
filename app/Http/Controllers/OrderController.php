<?php

namespace App\Http\Controllers;

use Square\Models\Order;
use Square\SquareClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Square\Models\CreateOrderRequest;
use App\Models\Orders;
use App\Services\OrdersService;

class OrderController extends Controller
{
    public function index()
    {
        $orders = [];
        foreach (Orders::all() as $order) {
            $orders[] = $order;
        }

        return view('orders.index', ['orders' => $orders]);
    }


    public function store(Request $request)
    {
        app(OrdersService::class)->store();
    }
}
