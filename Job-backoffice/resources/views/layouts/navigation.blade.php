<nav class="w-[250px] h-screen bg-white border-r border-gray-200">
    <!-- logo  -->
    <div class="flex items-center px-6 border-b border-gray-200 py-4">
        <a href="{{ route("dashboard") }}" class="text-2xl font-bold flex items-center space-x-2">
            <x-application-logo class="h-6 w-auto fill-current text=gray-800" />
            <span class="text-lg font-semibold text-gray-800">shaghalni</span>
        </a>
    </div>
    <!-- navigation -->
    <ul>
        <x-nav-link :href="route('dashboard')" :active="request()->rouyeIs('dashboard')">
            Dashboard
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->rouyeIs('dashboard')">
            Companies
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->rouyeIs('dashboard')">
                
        </x-nav-link>
    </ul>
</nav>