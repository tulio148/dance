<x-guest-layout>
    <div class="w-full h-36 border">
        <form action="{{ route('classes.store') }}" method="POST">
            @csrf
            <button type="submit">create class</button>
        </form>
    </div>
</x-guest-layout>
