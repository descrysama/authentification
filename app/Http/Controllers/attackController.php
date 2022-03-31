<?php

namespace App\Http\Controllers;

use App\Models\attack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class attackController extends Controller
{
    public function index()
    {
        $methods = ['NTP', 'UDP', 'SNMP', 'SSDP'];
        $attacks = attack::all()->where('sender_id', Auth::user()->id);
        return view('dashboard.attack', ['methods' => $methods], ['attacks' => $attacks]);
    }
}
