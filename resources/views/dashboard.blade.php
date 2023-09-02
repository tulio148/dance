<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <form action="{{ route('customer.create') }}" method="POST">
        @csrf
        <button type="submit">create customer</button>
    </form>


</x-app-layout>
