<?php

namespace App\Http\Controllers;

use App\Models\attack;
use Illuminate\Http\Request;

class attackController extends Controller
{
    public function index()
    {
        $methods = ['NTP', 'UDP', 'SNMP', 'SSDP'];
        $attacks = attack::all();
        return view('dashboard.attack', ['methods' => $methods], ['attacks' => $attacks]);
    }
}
