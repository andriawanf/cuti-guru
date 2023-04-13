<div>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ml-2 md:mr-24">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo" />
                        <span
                            class="self-center text-xl font-black sm:text-2xl whitespace-nowrap font-roboto dark:text-white">CuTeach</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="">

                            <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                                class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400"
                                type="button">
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                                    </path>
                                </svg>
                                <div class="relative flex">
                                    <div class="relative inline-flex w-3 h-3 text-red-500 border-2 border-white rounded-full -top-4 right-3">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </div>
                                </div>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNotification"
                                class="z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-800 dark:divide-gray-700"
                                aria-labelledby="dropdownNotificationButton">
                                <div
                                    class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                                    Notifications
                                </div>
                                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                                    @foreach (Auth::user()->unreadNotifications as $notification)
                                        <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="flex-shrink-0">
                                                <img class="rounded-full w-11 h-11"
                                                    src="{{ Auth::user()->foto }}" alt="Jese image">
                                                <div
                                                    class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                                                    <svg class="w-3 h-3 text-white" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                                        </path>
                                                        <path
                                                            d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="w-full pl-3">
                                                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                                                    {{ $notification->data['data'] }}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach ()

                                    @foreach (Auth::user()->readNotifications as $notification)
                                        <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <div class="flex-shrink-0">
                                                <img class="rounded-full w-11 h-11"
                                                    src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">
                                                <div
                                                    class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                                                    <svg class="w-3 h-3 text-white" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                                                        </path>
                                                        <path
                                                            d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="w-full pl-3">
                                                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                                                    {{ $notification->user['status'] }}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <a href="#"
                                    class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
                                    <div class="inline-flex items-center ">
                                        <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        View all
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="flex flex-row items-center w-full">
                            <h1 class="mr-4 font-roboto font-medium">{{ Auth::user()->name }}</h1>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full object-cover"
                                    src="/foto_user/{{ Auth::user()->foto }}" alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 mr-4 p-3 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3 border-b-2" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300"
                                    role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                @if (Auth::user()->level == 'admin' || Auth::user()->level == 'kepala sekolah')
                                    <li>
                                        <a href="{{ route('dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Dashboard</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('home') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Dashboard</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('settings') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-700 hover:text-white dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
