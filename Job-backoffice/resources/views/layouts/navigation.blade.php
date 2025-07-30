<nav class="w-[250px] h-screen bg-white border-r border-gray-200">
    <!-- logo  -->
    <div class="flex items-center px-6 border-b border-gray-200 py-4">
        <a href="{{ route("dashboard") }}" class="text-2xl font-bold flex items-center space-x-2">
            <x-application-logo class="h-6 w-auto fill-current text=gray-800" />
            <span class="text-lg font-semibold text-gray-800">shaghalni</span>
        </a>
    </div>
    <!-- navigation -->
    <ul class="flex flex-col px-4 py-6 space-y-2">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard.index')">
            Dashboard
        </x-nav-link>
        <x-nav-link :href="route('company.index')" :active="request()->routeIs('company.index')">
            Companies
        </x-nav-link>
        <x-nav-link :href="route('job-category.index')" :active="request()->routeIs('job-category.index')">
            Job Categories
        </x-nav-link>
        <x-nav-link :href="route('job-vacancy.index')" :active="request()->routeIs('job-vacancy.index')">
            Job Vacancies
        </x-nav-link>
        <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
            Users
        </x-nav-link>
        <hr>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <!-- Using utilities: -->
            <button type="submit" class="bg-red-500 w-full hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Logout
            </button>
        </form>
    </ul>
</nav>