<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Job informations
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
               
                <x-previous-page-arrow :default="route('job-vacancy.index') " :comeBack="true"/>   

            </div>

            <div class="mt-6">
                <h3 class="text-bold text-2xl">#{{$jobVacancy->title}}</h3>
                <div class="p-4">
                    <div class="mt-3">
                        <strong>Company:</strong>
                        <p>
                            <a href="{{ route("company.show", $jobVacancy->company->id) }}"
                                class="hover:underline text-blue-500">
                                {{$jobVacancy->company->name}}.
                            </a>
                        </p>
                    </div>
                    <div class="mt-3">
                        <strong>Description:</strong>
                        <p>
                            {{$jobVacancy->description}}
                        </p>
                    </div>
                    <div class="mt-3">
                        <strong>Address:</strong>
                        <p>{{$jobVacancy->location}}</p>
                    </div>
                    <div class="mt-3">
                        <strong>Salary:</strong>
                        <p>${{number_format($jobVacancy->salary, 2)}}</p>
                    </div>
                    <div class="mt-3">
                        <strong>Employment type:</strong>
                        <p>{{$jobVacancy->employment_type}}</p>
                    </div>
                    <div class="mt-3 flex justify-end items-center space-x-4">
                        <a href="{{ route("job-vacancy.edit", $jobVacancy->id) }}" class=" text-blue-500 hover:text-blue-800">Edit</a>
                        
                        <!-- archived -->
                        <form action="{{ route("job-vacancy.destroy", $jobVacancy->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class=" text-red-500 hover:text-red-800">Archive</button>

                        </form>

                    </div>
                </div>

            </div>


        </div>
        <div class="w-full p-6 rounded-lg shadow bg-white mt-4">
            <div class="flex justify-between items-center">
                <h3 class="text-bold text-2xl">Applications</h3>
                @if (request()->input("ArchivedApplications") == "true" && request()->input("ArchivedApplications"))
                    <a href="{{ route("job-vacancy.show", ["job_vacancy" => $jobVacancy->id, "ArchivedApplications" => "false"]) }}"
                        class="underline px-4 py-2 rounded-lg">Active</a>
                @else
                    <a href="{{ route("job-vacancy.show", ["job_vacancy" => $jobVacancy->id, "ArchivedApplications" => "true"]) }}"
                        class="underline px-4 py-2 rounded-lg">Archived</a>
                @endif
            </div>

            <hr>
            <!-- Jobs Container -->
          
            <div class="">

                <table class="min-w-full divide-y divide-gray-200 rounded-lg mt-4 bg-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 ">
                                id
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Name</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Ai Score</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php
                            $counter = 1;
                        @endphp
                        @forelse ($jobVacancy->applications as $application)
                            <tr>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $counter }}</td>


                                <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                                    @if (request()->input("archived") === "true")
                                        <span>
                                            {{$application->user->name}}
                                        </span>
                                    @else
                                        <a href="{{ route("job-application.show", $application->id) }}"
                                            class="text-blue-500 hover:underline">
                                            {{$application->user->name}}
                                        </a>
                                    @endif


                                </td>

                                <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                                    {{$application->AiScore * 10}}%
                                </td>
                                
                                <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                             @switch($application->status)
                                @case('accepted')
                                  <span
                                      class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset">approved</span>

                                   @break
                                @case('rejected')
                            <span
                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset">rejected</span>
                        
                                    @break
                                 @default
                                  <span
                                      class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-yellow-600/20 ring-inset">Pending</span>
                            
                                @endswitch


                                </td>
                            </tr>
                            @php
                                $counter++;
                            @endphp

                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-3 text-center text-sm font-semibold text-gray-800">
                                    No Application Found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>


        </div>
    </div>
</x-app-layout>