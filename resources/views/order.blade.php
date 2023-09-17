<x-guest-layout>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <button type="submit">create order</button>
    </form>
</x-guest-layout>
