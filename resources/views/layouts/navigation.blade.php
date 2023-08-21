<nav x-data="{ open: false }" class="bg-gray-300 border-b border-gray-100 fixed w-full h-auto">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Profile Settings Dropdown -->
            <div class="hidden sm:flex ">
                <!-- Navigation Links -->
                @if (auth()->check())
                    <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                @endif
                <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('subscribe')" :active="request()->routeIs('subscribe')">
                        {{ __('Subscribe') }}
                    </x-nav-link>
                </div>
            </div>
            @if (auth()->check())
                <div class=" sm:flex sm:items-center sm:ml-5 ">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="bg-gray-300  inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <img class="w-7 h-7"
                                    src="
                                {{ asset('storage/' . Auth::user()->id . '.jpg') }}"
                                    alt="Avatar">

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('subscribe')" :active="request()->routeIs('subscribe')">
                {{ __('Subscribe') }}
            </x-responsive-nav-link>
        </div>
</nav>
