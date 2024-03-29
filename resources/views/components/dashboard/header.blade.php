<header class="z-10 py-4 bg-white shadow-sm dark:bg-gray-800">
    <div class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300">

        @if (!$simpleLayout)
            <!-- Mobile hamburger -->
            <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                @click="toggleSideMenu" aria-label="Menu">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <ul class="flex items-center flex-shrink-0 ml-auto space-x-6">
                @if (!Auth::check())
                    <li class="relative">
                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                            href="{{ route('login') }}">
                            Iniciar Sessão
                        </a>
                    </li>
                    <li class="relative">
                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                            href="{{ route('register') }}">
                            Criar Conta
                        </a>
                    </li>
                @endif

                @if (Auth::check())
                    <li class="relative">
                        <span
                            class="inline-flex items-center w-full py-1 text-sm font-semibold transition-colors duration-150 rounded-md cursor-pointer"
                            @click="toggleProfileMenu" @keydown.escape="closeProfileMenu">
                            <div>{{ Auth::user()->name }}</div>
                        </span>
                    </li>
                    <li class="relative">
                        <button class="pr-2 align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                            @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                            aria-haspopup="true">
                            @if (Auth::user()->foto_url)
                                <img class="object-cover w-8 h-8 rounded-full"
                                    src="{{ asset('storage/fotos/' . Auth::user()->foto_url) }}" alt="profile picture"
                                    aria-hidden="true" />
                            @else
                                <img class="object-cover w-8 h-8 rounded-full" src="{{ asset('storage/fotos/default.png') }}"
                                    alt="profile picture" aria-hidden="true" />
                            @endif
                        </button>
                        <!-- Profile menu -->
                        <template x-if="isProfileMenuOpen">
                            <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0" @click.away="closeProfileMenu"
                                @keydown.escape="closeProfileMenu"
                                class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                                aria-label="submenu">
                                @if (!Auth::user()->isEmployee())
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="{{ route('profile.index') }}">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            <span>Perfil</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="flex">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md mr-14 hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <svg class="w-4 h-4 mr-3 " aria-hidden="true" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path
                                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span>Terminar Sessão</span>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </template>
                    </li>
                @endif

            </ul>
        @else
            <a class="text-lg font-bold text-gray-800 dark:text-gray-200" href="/">
                CineMagic
            </a>
        @endif
    </div>
</header>
