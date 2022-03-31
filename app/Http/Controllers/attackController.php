<?php

namespace App\Http\Controllers;

use App\Models\attack;
use App\Models\method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\planController;

class attackController extends Controller
{
    public function index()
    {
        $methods = method::all();
        $attacks = attack::all()->where('sender_id', Auth::user()->id);
        return view('dashboard.attack', ['methods' => $methods], ['attacks' => $attacks]);
    }

    public function l4attack(Request $request)
    {
        $request->validate([
            'ip' => ['required', 'ipv4'],
            'port' => ['required', 'integer'],
            'length' => ['required', 'integer', planController::check(Auth::user()->rank)],
            'method' => ['required', 'string']
        ]);
        
        attack::create(['ip' => $request->ip, 'port' => $request->port, 'length' => $request->length, 'method' => $request->method,'sender_id'=> Auth::user()->id]);
        return redirect('/attack');
    }

    public function stopAttack($id)
    {
        $attack = attack::find($id);
        $attack->state = 0;
        $attack->save();
        return redirect('/attack');
    }
}
