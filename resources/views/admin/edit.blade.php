<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing :') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                
                <div class="p-6 bg-white border-b border-gray-200 w-full flex justify-center">
                    <form class="flex flex-col w-half" action="{{url('update', $user->id)}}" method="POST">
                        @csrf
                        <label class="m-2" for="Name">Name :</label>
                        <input id="Name" type="text" name="name" placeholder="Name" value="{{$user->name}}">
                        <label class="m-2" for="Email">Email :</label>
                        <input id="Email" type="email" name="email" placeholder="Email" value="{{$user->email}}">
                            @switch($user->role)
                                @case(2)
                                <label class="m-2" for="idrole">Role :</label>
                                <select name="role" id="idrole">
                                    <option value="2">Ban</option>
                                    <option value="0">Unban</option>
                                </select>
                                @break
                                @case(1)
                                <label class="m-2" for="idrole">Role :</label>
                                <select name="role" id="idrole">
                                    <option value="1">Admin</option>
                                    <option value="0">User</option>
                                </select>
                                @break
                                @case(0)
                                <label class="m-2" for="idrole">Role :</label>
                                <select name="role" id="idrole">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                                @break
                            @endswitch
                            <label class="m-2" for="Rank">Rank :</label>
                                <select name="rank" id="Rank">
                                    @if ($user->rank > 0)
                                        <option value="{{$currentplan->id}}">{{$currentplan->name}}</option>
                                    @endif
                                        @foreach($plans as $plan)
                                        <option value="{{$plan->id}}">{{$plan->name}}</option>
                                    @endforeach
                                    <option value="0">None</option>
                                </select>
                        <input class="submitbutton" type="submit" value="Valider">
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
