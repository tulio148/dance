<x-guest-layout>

    <h1>Orders</h1>
    <ul>
        @foreach ($orders as $order)
            <p>{{ $order->id }}</p>
        @endforeach
    </ul>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <button type="submit">create order</button>
    </form>
</x-guest-layout>
