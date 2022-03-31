<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Method') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                
                <div class="p-6 bg-white border-b border-gray-200 w-full flex justify-center">
                    <form class="flex flex-col w-half" action="{{ route('storemethod') }}" method="POST">
                        @csrf
                        <label for="Name">Method Name :</label>
                        <input id="Name" type="text" name="name" placeholder="UDP" value=""> 
                        <input class="submitbutton" type="submit" value="Valider">
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
