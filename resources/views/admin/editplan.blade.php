<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing :') }} {{ $plan->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                
                <div class="p-6 bg-white border-b border-gray-200 w-full flex justify-center">
                    <form class="flex flex-col w-half" action="{{url('plans/update', $plan->id)}}" method="POST">
                        @csrf
                        <label for="Name">Name :</label>
                        <input id="Name" type="text" name="name" placeholder="Name" value="{{$plan->name}}">
                        <label for="Price">Price :</label>
                        <input id="Price" type="text" name="price" placeholder="Price" value="{{$plan->price}}">   
                        <label for="Length">Length (in seconds) :</label>
                        <input id="Length" type="text" name="length" placeholder="Length" value="{{$plan->length}}">
                        <label for="days">Expire (in days) :</label>
                        <input id="days" type="text" name="days" placeholder="Days" value="{{$plan->days}}">  
                        <input class="submitbutton" type="submit" value="Valider">
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
