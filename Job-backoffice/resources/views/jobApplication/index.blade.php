<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Job Applications {{ request()->input("archived") == "true" ? "(Archived)" : "" }}
        </h2>
    </x-slot>


    <!-- success -->


    @if (session('success'))
        <x-toast-notification>
            {{ session('success') }}
        </x-toast-notification>
    @endif




    <div class="overflow-x-auto p-6">
        <!-- create job category btn -->
        <div class="w-full flex justify-end items-center space-x-4 pb-1">

            @if (request()->has("archived") && request("archived") == "true")
                <a href="{{ route('job-application.index', ["archived" => "false"]) }}"
                    class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                    active
                </a>
            @else
                <a href="{{ route('job-application.index', ["archived" => "true"]) }}"
                    class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                    archived
                </a>
            @endif

        </div>
        <!-- job Category table -->
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow mt-4 bg-white">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 ">
                        id
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Name</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Job</th>
                    @if (auth()->user()->role === "admin")
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Company</th>
                    @endif
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Score</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @php
                    $counter = 1;
                @endphp
                @forelse ($applications as $application)
                    <tr>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $counter }}</td>


                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                            @if (request()->input("archived") === "true")
                                <span>
                                    {{ $application->user->name }}
                                </span>
                            @else
                                <a href="{{ route("job-application.show", $application->id) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $application->user->name }}
                                </a>
                            @endif


                        </td>

                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                            @if (request()->input("archived") === "true")
                                <span>
                                    {{ $application->jobVacancy->title }}
                                </span>
                            @else
                                <a href="{{ route("job-vacancy.show", $application->jobVacancy->id) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $application->jobVacancy->title }}
                                </a>
                            @endif


                        </td>

                        @if (auth()->user()->role === "admin")
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                            @if (request()->input("archived") === "true")
                                <span>
                                    {{ $application->jobVacancy->company->name }}
                                </span>
                            @else
                                <a href="{{ route("company.show", $application->jobVacancy->company->id) }}"
                                    class="text-blue-500 hover:underline">
                                    {{ $application->jobVacancy->company->name }}
                                </a>
                            @endif
                        </td>
                        @endif



                        
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                            {{ $application->AiScore * 10}}%
                        </td>
                        <td class=" px-4 py-3 text-sm font-semibold text-gray-800">
                            


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
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">

                            @if (request()->has("archived") && request("archived") == "true")

                                <!-- archived -->

                                <form class="flex-1 text-red-500 hover:text-red-800"
                                    action="{{ route("job-application.restore", $application->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit">restore</a>

                                </form>
                            @else


                                <!-- archived -->
                                <form class="flex-1 text-red-500 hover:text-red-800"
                                    action="{{ route("job-application.destroy", $application->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Archive</a>

                                </form>

                            @endif


                        </td>
                    </tr>
                    @php
                        $counter++;
                    @endphp

                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-3 text-center text-sm font-semibold text-gray-800">
                            No job Vacancies Found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</x-app-layout>