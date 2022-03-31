<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }} : {{Auth::user()->name}}
        </h2>
    </x-slot>
    <div class="py-12 text-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-green-600 m-2">To change any of your informations you'll need to enter you current password.</h2>
            <div class="bg-white overflow-hidden flex justify-center shadow-sm sm:rounded-lg">
                <form class="flex flex-col" action="{{route('selfupdate')}}" method="POST">
                    @csrf
                    <label class="m-2" for="email">Email <span class="text-green-600">( Not Required)</span> :</label>
                    <input type="text" name="email" id="email" placeholder="Email" value="{{Auth::user()->email}}">

                    <label class="m-2" for="new_password">New Password <span class="text-green-600">(Not Required)</span> :</label>
                    <input type="password" name="new_password" id="new_password" placeholder="new password">

                    <label class="m-2" for="new_confirm_password">New Password <span class="text-green-600">(Not Required)</span> :</label>
                    <input type="password" name="new_confirm_password" id="new_confirm_password" placeholder="confirm password">

                    <label class="m-2 mt-8" for="ip">Current Password <span class="text-red-600">(Required)</span> :</label>
                    <input type="password" name="password" id="password" placeholder="current password">

                    <input class="submitbutton" type="submit" value="Save">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
