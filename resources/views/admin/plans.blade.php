<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('admin')" :active="request()->routeIs('admin')">
                    {{ __('Users') }}
                </x-nav-link>
                <x-nav-link :href="route('plans')" :active="request()->routeIs('plans')">
                    {{ __('Plans') }}
                </x-nav-link>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <table class="table w-full">
                    <thead>
                        <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Attack Duration</th>
                        <th>Length</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                        <tr>
                            <td>{{$plan->id}}</td>
                            <td>{{$plan->name}}</td>
                            <td>{{$plan->price}} €</td>
                            <td>{{$plan->length}} seconds</td>
                            <td>{{$plan->days}} days</td>
                            <td>
                                <div class="hidden sm:flex sm:items-center sm:ml-6">
                                    <x-dropdown width="48">
                                        <x-slot name="trigger">
                                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                                <div>Actions</div>

                                                <div class="ml-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Authentication -->
                                            @if (Auth::user()->role == 1)
                                            <x-dropdown-link :href="url('plans', $plan->id)">{{ __('Edit') }}</x-dropdown-link>
                                            @endif
                                            @if (Auth::user()->role == 1)
                                            <x-dropdown-link  style="color:red;" :href="url('plans/delete', $plan->id)">{{ __('Delete') }}</x-dropdown-link>
                                            @endif
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{route('createplan')}}" class="submitbutton">Create</a>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
