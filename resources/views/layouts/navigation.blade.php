<nav x-data="{ open: false }" >
    <!-- Primary Navigation Menu -->
    <div >
        <div >
            <div >
                <!-- Logo -->
                <div >
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo  />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div >
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div >
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button >
                            <div>{{ Auth::user()->name }}</div>

                            <div >
                                <svg >
                                    <path  />
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

            <!-- Hamburger -->
            <div >
                <button @click="open = ! open" >
                    <svg >
                        <path   />
                        <path  />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div >
        <div >
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div >
            <div >
                <div >{{ Auth::user()->name }}</div>
                <div >{{ Auth::user()->email }}</div>
            </div>

            <div >
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
