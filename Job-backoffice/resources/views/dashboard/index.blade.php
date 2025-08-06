<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- over view -->
            <div class="w-full flex space-x-6">
                <div class="bg-white flex-1 overflow-hidden shadow-sm sm:rounded-lg p-4 shadow items-between">
                    <h2 class="text-xl font-medium  mb-4">
                        Active Users
                    </h2>
                    <p class="text-5xl text-violet-700">{{ $analytics['activeUsers'] }}</p>
                    <span class="text-sm text-gray-500">Last 30 days</span>
                </div>
                <div class="bg-white flex-1 overflow-hidden shadow-sm sm:rounded-lg p-4 shadow">
                    <h2 class="text-xl font-medium  mb-4">
                        Total Jobs
                    </h2>
                    <p class="text-5xl text-violet-700">{{ $analytics['totalJobs'] }}</p>
                    <span class="text-sm text-gray-500">All time</span>
                </div>
                <div class="bg-white flex-1 overflow-hidden shadow-sm sm:rounded-lg p-4 shadow">
                    <h2 class="text-xl font-medium  mb-4">
                        Total applications
                    </h2>
                    <p class="text-5xl text-violet-700">{{ $analytics['totalApplications'] }}</p>
                    <span class="text-sm text-gray-500">All time</span>
                </div>
            </div>
            <!-- Most applied Jobs -->
            <div class="w-full flex space-x-6 my-6">
                <div class="bg-white flex-1 overflow-hidden shadow-sm sm:rounded-lg p-4 shadow">
                    <h2 class="text-xl font-medium  mb-4">
                        Most Applied Jobs
                    </h2>
                    <div class="">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg mt-4 bg-white">
                            <thead>
                                <tr class="text-gray-500">
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600 w-10">ID</th>
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600">JOB TITLE</th>
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600">COMPANY</th>
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600">APPLICATIONS
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @php
                                    $counter = 1;
                                @endphp

                                @forelse ($mostAppliedJobs as $job)

                                    <tr>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">{{ $counter }}
                                        </td>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">
                                            {{ $job->title }}
                                        </td>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">
                                            {{ $job->company->name }}
                                        </td>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">
                                            {{ $job->applicationsCount}}
                                        </td>
                                    </tr>

                                    @php
                                        $counter++;
                                    @endphp
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-3 text-center text-sm font-semibold text-gray-800">
                                            No Jobs found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Top Converting Job Posts -->
            <div class="w-full flex space-x-6 my-6">
                <div class="bg-white flex-1 overflow-hidden shadow-sm sm:rounded-lg p-4 shadow">
                    <h2 class="text-xl font-medium  mb-4">
                        Top Converting Job Posts
                    </h2>
                    <div class="">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg mt-4 bg-white">
                            <thead>
                                <tr class="text-gray-500">
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600 w-10">ID</th>
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600">JOB TITLE</th>
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600">VIEWS</th>
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600">APPLICATIONS
                                    </th>
                                    <th class="px-6 py-3 text-start text-sm font-semibold text-gray-600">CONVERTION RATE
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @php
                                    $counter = 1;
                                @endphp

                                @forelse ($convertionRates as $convertionRate)

                                    <tr>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">{{ $counter }}
                                        </td>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">
                                            {{ $convertionRate->title }}
                                        </td>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">
                                            {{ $convertionRate->viewCount }}
                                        </td>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">
                                            {{ $convertionRate->applicationsCount}}
                                        </td>
                                        <td class="px-6 py-3 text-sm font-semibold text-gray-800">
                                            {{ $convertionRate->convertionRate}}%
                                        </td>
                                    </tr>

                                    @php
                                        $counter++;
                                    @endphp
                                @empty

                                    <tr>
                                        <td colspan="5" class="px-6 py-3 text-center text-sm font-semibold text-gray-800">
                                            No Converting Jobs found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>