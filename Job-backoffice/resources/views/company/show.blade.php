<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $company->name }} (Company)
        </h2>
    </x-slot>


    <!-- success -->


    @if (session('success'))
        <x-toast-notification>
            {{ session('success') }}
        </x-toast-notification>
    @endif




    <div class="overflow-x-auto p-6">
        <div class="w-full px-6 py-4 rounded-lg shadow bg-white">
            <div class="mb-4 flex items-center space-x-2">
                <a href="{{ route("company.index") }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-arrow-right-short rotate-180" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                    </svg>
                </a>

            </div>

            <h3 class="text-bold text-2xl">Company informations</h3>

            <div class="mt-4">
                <p><strong>Owner Name:</strong> {{ $company->owner->name }}</p>
                <p><strong>Company Name:</strong> {{ $company->name }}</p>
                <p><strong>Owner Email:</strong> {{ $company->owner->email }}</p>
                <p><strong>Address:</strong> {{ $company->location }}</p>
                <p><strong>Industry:</strong> {{ $company->industry }}</p>
                <p class="flex space-x-1"><strong>Website:</strong> <a style="color: #0000FF" target="blank"
                        class="flex" href="{{ $company->website }}">
                        visit
                        <svg class="w-4 h-4" viewBox="-6.4 -6.4 76.80 76.80" xmlns="http://www.w3.org/2000/svg"
                            stroke-width="3" stroke="#0000FF" fill="none" transform="rotate(0)">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M55.4,32V53.58a1.81,1.81,0,0,1-1.82,1.82H10.42A1.81,1.81,0,0,1,8.6,53.58V10.42A1.81,1.81,0,0,1,10.42,8.6H32">
                                </path>
                                <polyline points="40.32 8.6 55.4 8.6 55.4 24.18"></polyline>
                                <line x1="19.32" y1="45.72" x2="54.61" y2="8.91"></line>
                            </g>
                        </svg>
                    </a></p>

                <div class="w-full flex justify-end space-x-6">
                    <!-- edit -->
                    <a class=" text-blue-500 over:text-blue-800"
                        href="{{ route("company.edit", $company->id) }}">Edit</a>
                    <!-- archived -->
                    <form class=" text-red-500 hover:text-red-800" action="{{ route("company.destroy", $company->id) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Archive</a>
                    </form>
                </div>
            </div>



        </div>
        <div class="w-full p-6 rounded-lg shadow bg-white mt-4">
            <div class="flex justify-between items-center">
                <h3 class="text-bold text-2xl">Jobs</h3>
                @if (request()->input("ArchivedJobs") == "true" && request()->input("ArchivedJobs"))
                    <a href="{{ route("company.show", ["company" => $company->id, "ArchivedJobs" => "false"]) }}"
                        class="underline px-4 py-2 rounded-lg">Active</a>
                @else
                    <a href="{{ route("company.show", ["company" => $company->id, "ArchivedJobs" => "true"]) }}"
                        class="underline px-4 py-2 rounded-lg">Archived</a>
                @endif
            </div>

            <hr>
            <!-- Jobs Container -->
            <div class="">
                @forelse ($company->jobVacancies as $job)
                    <div class="mt-6">
                        <h3 class="text-bold text-2xl">#{{$job->title}}</h3>
                        <div class="p-4">
                            <div class="mt-3">
                                <strong>Description:</strong>
                                <p>
                                    {{$job->description}}
                                </p>
                            </div>
                            <div class="mt-3">
                                <strong>Address:</strong>
                                <p>{{$job->location}}</p>
                            </div>
                            <div class="mt-3">
                                <strong>Salary:</strong>
                                <p>{{$job->salary}}</p>
                            </div>
                            <div class="mt-3">
                                <strong>Employment type:</strong>
                                <p>{{$job->employment_type}}</p>
                            </div>
                            <div class="mt-3 flex justify-end items-center space-x-4">
                                <a href="" class=" text-blue-500 hover:text-blue-800">Applications</a>
                                <a href="" class=" text-blue-500 hover:text-blue-800">Edit</a>
                                <a href="" class=" text-red-500 hover:text-red-800">Archive</a>
                            </div>
                        </div>

                    </div>

                    <hr>
                @empty
                    <p>There is no jobs.</p>
                @endforelse

            </div>




        </div>
    </div>
</x-app-layout>