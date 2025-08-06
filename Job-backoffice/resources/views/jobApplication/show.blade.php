<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$application->user->name}} applied to {{ $application->jobVacancy->title }} 



@switch($application->status)
                                @case('accepted')
                                  <span
                                      class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset">Approved</span>

                                   @break
                                @case('rejected')
                            <span
                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset">Rejected</span>
                        
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
                    <div class="mt-6">
                        <p><Strong>Applicant: </Strong>{{$application->user->name}}</p>
                        <p><Strong>Job: </Strong><a href="{{ route("job-vacancy.show" , $application->jobVacancy->id) }}" class="text-blue-500 hover:text-blue-800">{{$application->jobVacancy->title}} </a></p>
                        <p><Strong>Company: </Strong>
                        <a href="{{ route("job-vacancy.show" , $application->jobVacancy->id) }}" class="text-blue-500 hover:text-blue-800">{{$application->jobVacancy->company->name}}</a>
                    </p>
                    <p class="flex space-x-1"><strong>Resume:</strong> <a  target="blank"
                        class="flex text-blue-500 hover:text-blue-800" href="{{ $application->resume->fileUri }}">
                        veiw
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
                    <p>
                    <div x-data="{ 
                          status: '{{ $application->status }}',
                          originalStatus: '{{ $application->status }}',
                          isChanged: false
                      }" 
                      x-init="$watch('status', (newValue) => {
                          isChanged = newValue !== originalStatus;
                      })"
                      class="w-full flex justify-start items-center space-x-2">

                      
                                <strong>Status:</strong>
                           
                                
                             
                             <form action="{{ route('job-application.update', $application->id) }}" method="POST" class="flex items-center space-x-2">
                                 @csrf
                                 @method('PATCH')
                                 <select 
                                     name="status"
                                     x-model="status"
                                     :class="{
                                         'bg-green-50 text-green-700': status === 'accepted',
                                         'bg-yellow-50 text-yellow-800': status === 'pending',
                                         'bg-red-50 text-red-700': status === 'rejected'
                                     }"
                                     class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium appearance-none focus:outline-none focus:ring-0 border-0"
                                     style="background-image: none;"
                                 >
                                     <option value="accepted" class="bg-green-50 text-green-700 focus:bg-green-50 focus:text-green-700 hover:bg-green-50 hover:text-green-700">Approved</option>
                                     <option value="pending" class="bg-yellow-50 text-yellow-800 focus:bg-yellow-50 focus:text-yellow-800 hover:bg-yellow-50 hover:text-yellow-800">Pending</option>
                                     <option value="rejected" class="bg-red-50 text-red-700 focus:bg-red-50 focus:text-red-700 hover:bg-red-50 hover:text-red-700">Rejected</option>
                                 </select>
                                 
                                 <button 
                                     type="submit"
                                     x-show="isChanged"
                                     x-transition
                                     class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition-colors duration-200"
                                 >
                                     <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                     </svg>
                                     Save
                                 </button>
                             </form>
                                </div>
                  </p>

                   <div class="w-full flex justify-end items-center">
                     <form class="text-red-500 hover:text-red-800" action="{{ route("job-application.destroy", $application->id) }}" method="post">
                         @csrf
                         @method('DELETE')
                         <button type="submit">Archive</button>
                     </form>
                 </div>
                  
                    <div class="mt-6">
                        <h3 class="text-bold text-2xl">#{{$application->user->name}}</h3>
                        <div class="p-4">
                            <div class="mt-3">
                                <strong>summary:</strong>
                                <p>
                                    {{$application->resume->summary}}
                                </p>
                            </div>
                            <hr  class="my-4"/>
                            <div class="mt-3">
                                <strong>education:</strong>
                                <p>{{$application->resume->education}}</p>
                            </div>
                            <hr  class="my-4"/>

                            <div class="mt-3">
                                <strong>skills:</strong>
                                <p>{{$application->resume->skills}}</p>
                            </div>
                            <hr  class="my-4"/>

                            <div class="mt-3">
                                <strong>experience:</strong>
                                <p>{{$application->resume->experience}}</p>
                            </div>
                            <hr  class="my-4"/>

                            <div class="mt-3">
                                <strong>Contact details:</strong>
                                <p>{{$application->resume->contactDetails}}</p>
                            </div>
                            <hr  class="my-4"/>

                            <div class="mt-3">
                                <strong>AI score:</strong>
                                <p>{{$application->AiScore * 10}}%</p>
                            </div>
                            <hr  class="my-4"/>

                            <div class="mt-3">
                                <strong>AI feedback:</strong>
                                <p>{{$application->AiFeedback}}</p>
                            </div>
                        </div>

                    </div>

                    
              
            </div>


        </div>




    </div>
    </div>
</x-app-layout>