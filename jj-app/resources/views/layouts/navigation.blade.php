<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- KIRI: Logo / Judul -->
            <div>
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    JJ<span class="text-blue-500">Bubble</span>
                </h1>
            </div>

            <!-- KANAN: Nama User & Logout -->
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-700 dark:text-gray-300">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-3 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-sm shadow focus:outline-none transition">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
