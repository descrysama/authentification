<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\attack;
use App\Models\method;
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
        //api layer4 attack
        attack::create(['ip' => $request->ip, 'port' => $request->port, 'length' => $request->length, 'method' => $request->method,'launcher_id'=> Auth::user()->id, 'launched_at' => Carbon::now(), 'finished_at'=>Carbon::now()->addSecond($request->length)]);
        return redirect('/attack');
    }

    public function stopAttack($id)
    {
        $attack = attack::find($id);
        $attack->state = 0;
        $attack->save();
        //api layer4 stop
        return redirect('/attack');
    }
}
