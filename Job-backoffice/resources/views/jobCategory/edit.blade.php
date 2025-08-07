<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Job Categories') }}
        </h2>
    </x-slot>


    <div class="overflow-x-auto p-6">
        <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
            
            <x-previous-page-arrow :default="route('job-category.index') " :comeBack="false"/>   

            <form action="{{ route("job-category.update", $category->id) }}" method="post">
                @csrf
                @method("put")
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') ? old("name") : $category->name }}"
                        class="{{ $errors->has('name') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end items-center space-x-6">
                  
                    <x-previous-page-cancel :default="route('job-category.index')" :comeBack="false" />

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Edit Category
                    </button>
                </div>


            </form>
        </div>

    </div>
</x-app-layout>