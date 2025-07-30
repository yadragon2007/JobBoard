<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
    x-transition:enter="transition-opacity duration-500" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-500"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="absolute bottom-5 left-7  bg-green-100 border border-green-400 text-green-700 px-14 py-6 rounded"
    role="alert">
    <strong class="font-bold">Success!</strong>
    <span class="block sm:inline">

        {{ $slot }}
    </span>
</div>