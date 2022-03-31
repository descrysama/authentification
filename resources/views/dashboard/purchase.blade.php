<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchase') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden flex justify-center shadow-sm sm:rounded-lg">
                <div class="row">
                    @foreach($plans as $plan)
                        <div class="container-1 col-sm">
                            <div class="card-1">
                                <div class="box-1">
                                    <div class="content-1">
                                        <h2>{{$plan->name}}</h2>
                                        <h3>{{$plan->name}}</h3>
                                        <p> {{$plan->days}} days</p>
                                        <p> {{$plan->length}} seconds !</p>
                                        <p> Méthods Layer 4 & Layer 7.</p>
                                        <p> Unlimited Attacks.</p>
                                        <h3>{{$plan->price}} €</h3>
                                        <a href="buy/{{$plan->price}}">Purchase Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
