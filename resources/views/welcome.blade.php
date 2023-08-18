<x-guest-layout>
    <div class="front-page-content">
        <video width="320" height="240">
            <source src="{{ asset('public\video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <ul>
        <li><a href="/login">login</a></li>
        <li><a href="/register">register</a></li>
    </ul>

    @auth
        <h1>{{ Auth::user()->name }}</h1>
    @endauth
    @guest

        <h1>login</h1>
    @endguest

</x-guest-layout>
