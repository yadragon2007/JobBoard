<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Users {{ request()->input("archived") == "true" ? "(Archived)" : "" }}
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
                <a href="{{ route('user.index', ["archived" => "false"]) }}"
                    class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 active:bg-gray-700 disabled:opacity-25 transition ease-in-out duration-150">
                    active
                </a>
            @else
                <a href="{{ route('user.index', ["archived" => "true"]) }}"
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
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Name</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">email</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Role</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @php
                    $counter = 1;
                @endphp
                @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800">{{ $counter }}</td>
                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800">{{ $user->name }}</td>
                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800">{{ $user->email }}</td>
                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800">{{ $user->role }}</td>
                        <td class="px-6 py-3 text-center text-sm font-semibold text-gray-800 flex items-center">


                        @if ($user->role !== "admin")
                        @if (request()->has("archived") && request("archived") == "true")
                                <!-- archived -->
                                <form class="flex-1 text-red-500 hover:text-red-800"
                                    action="{{ route("user.restore", $user->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit">restore</a>

                                </form>
                            @else

                             
                                <!-- archived -->
                                <form class="flex-1 text-red-500 hover:text-red-800"
                                    action="{{ route("user.destroy", $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Archive</a>

                                </form>

                            @endif

                        @endif
                            

                        </td>
                    </tr>
                    @php
                        $counter++;
                    @endphp

                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-3 text-center text-sm font-semibold text-gray-800">
                            No Users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>