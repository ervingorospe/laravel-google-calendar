<nav class="z-100 bg-white w-full sticky items-center px-4 py-8 shadow-md">
    <div class="mx-autp flex w-full flex-wrap items-center justify-between px-4 md:flex-nowrap md:px-10">
        <a href="{{ route('dashboard') }}" class="text-gray-500 font-bold hover:underline">
            Home
        </a>
        <ul class="flex-col items-center md:flex md:flex-row space-x-4">
            <li class="text-gray-500 font-bold">Welcome, {{ $user->name }}</li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="button items-center group text-primary-600 border-primary-600 hover:bg-primary-600 border text-sm hover:text-white flex">
                        <svg class="h-4 w-auto fill-primary-600 mr-2 group-hover:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                        <span>
                            Logout
                        </span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
  