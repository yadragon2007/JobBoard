<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Job vacancies {{ request()->input("archived") == "true" ? "(Archived)" : "" }}
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
                <a href="{{ route('job-vacancy.index', ["archived" => "false"]) }}"
                    class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                    active
                </a>
            @else
                <a href="{{ route('job-vacancy.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 active:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                    Add a Job
                </a>
                <a href="{{ route('job-vacancy.index', ["archived" => "true"]) }}"
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
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Title</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Company</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Address</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Type</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Salary</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @php
                    $counter = 1;
                @endphp
                @forelse ($jobVacancies as $job)
                    <tr>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">{{ $counter }}</td>


                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                            @if (request()->input("archived") === "true")
                                <span>
                                    {{ $job->title }}
                                </span>
                            @else
                                <a href="{{ route("job-vacancy.show", $job->id) }}" class="text-blue-500 hover:underline">
                                    {{ $job->title }}
                                </a>
                            @endif


                        </td>

                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                            @if (request()->input("archived") === "true")
                                <span>
                                    {{ $job->company->name }}
                                </span>
                            @else
                                <a href="{{ route("company.show", $job->company->id) }}" class="text-blue-500 hover:underline">
                                    {{ $job->company->name }}
                                </a>
                            @endif


                        </td>

                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                            {{ $job->location }}
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">
                            {{ $job->employment_type }}
                        </td>
                        <td class=" px-4 py-3 text-sm font-semibold text-gray-800">
                            ${{number_format($job->salary, 2)}}
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-gray-800">

                            @if (request()->has("archived") && request("archived") == "true")

                                <!-- archived -->

                                <form class="flex-1 text-red-500 hover:text-red-800"
                                    action="{{ route("job-vacancy.restore", $job->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit">restore</a>

                                </form>
                            @else


                                <!-- archived -->
                                <form class="flex-1 text-red-500 hover:text-red-800"
                                    action="{{ route("job-vacancy.destroy", $job->id) }}" method="post">
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
            {{ $jobVacancies->links() }}
        </div>
    </div>
</x-app-layout>