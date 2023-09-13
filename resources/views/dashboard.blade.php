<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <form action="{{ route('customer.index') }}" method="GET">
        @csrf
        <button type="submit">get customer</button>
    </form>


    <form action="{{ route('customer.store') }}" method="POST">
        @csrf
        <button type="submit">create customer</button>
    </form>
    {{-- 
    <form action="{{ route('customer.payment') }}" method="POST" id="payment-form">
        @csrf
        <div id="card-container"></div>
        <div id="google-pay-button" alt="google-pay" type="button"></div>
        <input type="hidden" name="token" id="token">
        <input type="email" name="email">
        <button class="border-2 border-solid" id="card-button" type="button">Pay $1.00</button>
    </form>
    <div id="payment-status-container"></div> --}}



</x-app-layout>
