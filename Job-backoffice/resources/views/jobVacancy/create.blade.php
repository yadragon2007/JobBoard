<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add a job') }}
        </h2>
    </x-slot>


    <div class="overflow-x-auto p-6">
        <div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow">
            
            <x-previous-page-arrow :default="route('job-vacancy.index') " :comeBack="false"/>   

            <form action="{{ route("job-vacancy.store") }}" method="post">
                @csrf
                <div class="flex justify-between space-x-4">
                    <div class="flex-1 p-4 rounded-xl ">
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', "") }}"
                                class="{{ $errors->has('title') ? 'outline-1 outline-red-500 outline' : ''}}    mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>

                            <textarea
                                class="{{ $errors->has('description') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                rows="10" name="description" id="description">
                                {{ old('description', "") }}
                            </textarea>


                            @error('description')
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
                            <label for="salary" class="block text-sm font-medium text-gray-700">Salary (USD)</label>
                            <input type="number" name="salary" id="salary" value="{{ old('salary', "")}}"
                                class="{{ $errors->has('salary') ? 'outline-1 outline-red-500 outline' : ''}}  mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('salary')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Employment type -->


                        <div class="mb-4">
                            <label for="employment_type" class="block text-sm/6 font-medium text-gray-900">Employment
                                type</label>
                            <select id="employment_type" name="employment_type"
                                class="{{ $errors->has('employment_type') ? 'outline-1 outline-red-500 outline' : ''}} bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option {{!old("employment_type") ? "selected" : ""}} value="{{ null }}">Select Employment type</option>
                                <option value="Full-time" {{old("employment_type") == "Full-time" ? "selected" : ""}}>Full-time</option>
                                <option value="Part-time" {{old("employment_type") == "Part-time" ? "selected" : ""}}>Part-time</option>
                                <option value="Contract" {{old("employment_type") == "Contract" ? "selected" : ""}}>Contract</option>
                                <option value="Remote" {{old("employment_type") == "Remote" ? "selected" : ""}}>Remote</option>
                                <option value="Hybrid" {{old("employment_type") == "Hybrid" ? "selected" : ""}}>Hybrid</option>
                            </select>

                        </div>
                        @error('employment_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <!-- company -->
                        <div class="mb-4">
                            <label for="company_id" class="block text-sm/6 font-medium text-gray-900">Company</label>
                            <select id="company_id" name="company_id" 
                                class="{{ $errors->has('company_id') ? 'outline-1 outline-red-500 outline' : ''}} bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option {{!old("company_id") ? "selected" : ""}} value="{{ null }}">Select a Company</option>
                                @forelse($companies as $company)
                                     <option value="{{ $company->id }}" {{old("company_id") == $company->id ? "selected" : ""}}>
                                        {{$company->name}}
                                    </option>                               
                                     @empty
                                    <option>No companies found</option>
                                @endforelse
                            </select>

                        </div>
                        @error('company_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <!-- Job category -->
                        <div class="mb-4">
                            <label for="job_category_id" class="block text-sm/6 font-medium text-gray-900">Job
                                Category</label>
                            <select id="job_category_id" name="job_category_id"
                                class="{{ $errors->has('job_category_id') ? 'outline-1 outline-red-500 outline' : ''}} bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option {{!old("category_id") ? "selected" : ""}} value="{{ null }}">Select Job Category</option>


                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}" {{old("job_category_id") == $category->id ? "selected" : ""}}>
                                        {{$category->name}}
                                    </option>
                                @empty
                                    <option>No categories found</option>
                                @endforelse

                            </select>
                            @error('job_category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                </div>


                <div class="flex justify-end items-center space-x-6 mt-2">
                   
                    <x-previous-page-cancel :default="route('job-vacancy.index')" :comeBack="false" />

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Create Job Vacancy
                    </button>
                </div>


            </form>
        </div>

    </div>
</x-app-layout>