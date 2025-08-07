<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Companies {{ request()->input("archived") == "true" ? "(Archived)" : "" }}
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
                <a href="{{ route('company.index', ["archived" => "false"]) }}"
                    class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                    active
                </a>
            @else
                <a href="{{ route('company.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 active:bg-blue-700 focus:outline-none focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    add Company

                </a>
                <a href="{{ route('company.index', ["archived" => "true"]) }}"
                    class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                    archived
                </a>

            @endif

        </div>
        <!-- job Category table -->
        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow mt-4 bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600 w-10">
                        id
                    </th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Category Name</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @php
                    $counter = 1;
                @endphp
                @forelse ($companies as $company)
                    <tr>
                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800">{{ $counter }}</td>


                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800">
                            @if (request()->input("archived") === "true")
                                <span>
                                    {{ $company->name }}
                                </span>
                            @else
                                <a href="{{ route("company.show", $company->id) }}" class="hover:underline">
                                    {{ $company->name }}
                                </a>
                            @endif


                        </td>

                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800">
                            {{ $company->owner->email }}
                        </td>
                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800 flex items-center">

                            @if (request()->has("archived") && request("archived") == "true")

                                <!-- archived -->
                                <form class="flex-1 text-red-500 hover:text-red-800"
                                    action="{{ route("company.restore", $company->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit">restore</a>
                                </form>
                            @else


                                <!-- archived -->
                                <form class="flex-1 text-red-500 hover:text-red-800"
                                    action="{{ route("company.destroy", $company->id) }}" method="post">
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
                        <td colspan="3" class="px-6 py-3 text-center text-sm font-semibold text-gray-800">
                            No Companies Found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $companies->links() }}
        </div>
    </div>
</x-app-layout>