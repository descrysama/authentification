<?php

namespace App\Http\Controllers;

use App\Models\plan;
use Illuminate\Http\Request;

class planController extends Controller
{
    public function show() {
        $plans = plan::all();
        return view('dashboard.purchase', ['plans' => $plans]);
    }
}
