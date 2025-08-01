<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Company') }}
        </h2>
    </x-slot>


    <div class="overflow-x-auto p-6">
        <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
            <div class="mb-4 flex items-center space-x-2">
                <a href="{{ route("company.index") }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-arrow-right-short rotate-180" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                    </svg>
                </a>

            </div>
            <form action="{{ route("company.store") }}" method="post">
                @csrf
                <div class="flex justify-between space-x-4">


                    <!-- company owner -->
                    <div class="flex-1 p-4 rounded-xl ">
                        <div class="mb-4">
                            <h3 class="text-2xl text-bold">Owner Details</h3>
                        </div>
                        <div class="mb-4">
                            <label for="ownerName" class="block text-sm font-medium text-gray-700">Owner Name</label>
                            <input type="text" name="ownerName" id="ownerName" value="{{ old('email', "")}}"
                                class="{{ $errors->has('ownerName') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('ownerName')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', "") }}"
                                class="{{ $errors->has('email') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" value="{{ old('password', "") }}"
                                class="{{ $errors->has('password') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                                password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                value="{{ old('password_confirmation', "") }}"
                                class="{{ $errors->has('password_confirmation') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>




                    <div class="flex-1 p-4 rounded-xl ">
                        <div class="mb-4">
                            <h3 class="text-2xl text-bold">Company Details</h3>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input type="text" name="name" id="name" value="{{ old('email', "") }}"
                                class="{{ $errors->has('name') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                            <input type="text" name="industry" id="industry" value="{{ old('email', "") }}"
                                class="{{ $errors->has('industry') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('industry')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location', "")}}"
                                class="{{ $errors->has('location') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('location')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700">Website
                                (Optional)</label>
                            <input type="url" name="website" id="website" value="{{ old('website', "")}}"
                                class="{{ $errors->has('website') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('website')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>


                </div>


                <div class="flex justify-end items-center space-x-6 mt-2">
                    <a href="{{ route("company.index") }}">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Create company
                    </button>
                </div>


            </form>
        </div>

    </div>
</x-app-layout>