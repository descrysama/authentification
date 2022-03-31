<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attack') }}
        </h2>
    </x-slot>
    <div class="py-12 text-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden flex justify-center shadow-sm sm:rounded-lg">
                <form class="flex flex-col" action="{{route('l4attack')}}" method="POST">
                    @csrf
                    <label class="m-2" for="ip">Ip address  :</label>
                    <input type="text" name="ip" id="ip" placeholder="78.193.102.103">
                    <label class="m-2" for="ip">Port :</label>
                    <input type="text" name="port" id="port" placeholder="80">
                    <label class="m-2" for="length">Time :</label>
                    <input type="text" name="length" id="length" placeholder="120">
                    <label class="m-2" for="method"> Method :</label>
                                <select name="method" id="method">
                                    @foreach($methods as $method)
                                    <option value="{{$method->name}}">{{$method->name}}</option>
                                    @endforeach
                                </select>
                    <input class="submitbutton" type="submit" value="Attack">
                </form>
            </div>
        </div>
    </div>
    <div class="py-12 text-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden flex justify-center shadow-sm sm:rounded-lg">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Ip</th>
                            <th>Method</th>
                            <th>Length</th>
                            <th>Port</th>
                            <th>Date</th>
                            <th>State</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attacks as $attack)
                            <tr>
                                <td>{{$attack->ip}}</td>
                                <td>{{$attack->method}}</td>
                                <td>{{$attack->length}} seconds</td>
                                <td>{{$attack->port}}</td>
                                <td>{{$attack->created_at}}</td>
                                    @switch($attack->state)
                                        @case(1)
                                            <td style="color: red; font-weight: 700;">Running</td>
                                        @break

                                        @case(0)
                                            <td style="color: green; font-weight: 700;">Finished</td>
                                        @break
                                    @endswitch
                                @if($attack->state == 1)
                                <td>
                                    <form action="{{url('/attack/stop', $attack->id)}}" method="POST">
                                        @csrf
                                        <input class="submitbutton m-auto" type="submit" value="Stop">
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
