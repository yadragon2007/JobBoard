<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Application 



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
                <button href="{{ route("company.index") }}" onclick="window.history.back();">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-arrow-right-short rotate-180" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                    </svg>
                </button>

            </div>

            <div class="mt-6">
                @forelse ($jobVacancy->applications as $application)
                    <div class="mt-6">
                        <h3 class="text-bold text-2xl">#{{$application->user->name}}</h3>
                        <div class="p-4">
                            <div class="mt-3">
                                <strong>summary:</strong>
                                <p>
                                    {{$application->resume->summary}}
                                </p>
                            </div>
                            <div class="mt-3">
                                <strong>education:</strong>
                                <p>{{$application->resume->education}}</p>
                            </div>
                            <div class="mt-3">
                                <strong>skills:</strong>
                                <p>{{$application->resume->skills}}</p>
                            </div>
                            <div class="mt-3">
                                <strong>experience:</strong>
                                <p>{{$application->resume->experience}}</p>
                            </div>
                            <div class="mt-3">
                                <strong>Contact details:</strong>
                                <p>{{$application->resume->contactDetails}}</p>
                            </div>
                            <div class="mt-3">
                                <strong>AI score:</strong>
                                <p>{{$application->AiScore * 10}}%</p>
                            </div>
                            <div class="mt-3">
                                <strong>AI feedback:</strong>
                                <p>{{$application->AiFeedback}}</p>
                            </div>
                             <div class="mt-3">
                                <strong>Status:</strong>
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
                                </div>
    
                               
                              
                            <div class="mt-3 flex justify-end items-center space-x-4">
                                <a href="" class=" text-red-500 hover:text-red-800">Archive</a>
                            </div>
                        </div>

                    </div>

                    <hr>
                @empty
                    <p>There is no applications yet.</p>
                @endforelse

            </div>


        </div>




    </div>
    </div>
</x-app-layout>