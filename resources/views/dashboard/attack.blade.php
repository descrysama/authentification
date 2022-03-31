<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attack') }}
        </h2>
    </x-slot>
    <div class="py-12 text-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden flex justify-center shadow-sm sm:rounded-lg">
                <form class="flex flex-col" action="" method="POST">
                    <label for="ip">Ip adress :</label>
                    <input type="text" name="ip" id="ip" placeholder="78.193.102.103">
                    <label for="ip">Port :</label>
                    <input type="text" name="port" id="port" placeholder="80">
                    <label for="length">Time :</label>
                    <input type="text" name="length" id="length" placeholder="120">
                    <label for="method"> Method :</label>
                                <select name="method" id="method">
                                    @foreach($methods as $method)
                                    <option value="{{$method}}">{{$method}}</option>
                                    @endforeach
                                </select>
                    <input class="submitbutton" type="submit" value="Send">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attacks as $attack)
                        <tr>
                            <td>{{$attack->ip}}</td>
                            <td>{{$attack->method}}</td>
                            <td>{{$attack->length}}</td>
                            <td>{{$attack->port}}</td>
                            <td>{{$attack->create_at}}</td>
                            <td><a href="attack/stop/{{$attack->state}}"><input class="submitbutton" type="submit" value="Stop"></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
