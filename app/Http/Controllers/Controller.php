<?php

namespace App\Http\Controllers;

use App\Models\attack;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard()
    {
        $users = User::all();
        $attacks = attack::all();
        return view('dashboard', ['users' => $users], ['attacks' => $attacks]);
    }
}
