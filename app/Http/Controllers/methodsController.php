<?php

namespace App\Http\Controllers;

use App\Models\method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class methodsController extends Controller
{
    public function index()
    {
        $methods = method::all();
        return view('admin.methods', ['methods' => $methods]);
    }

    public function create()
    {
        return view('admin.createmethod');
    }

    public function deleteMethod($id)
    {
        if (Auth::user()->role == 1){
            method::find($id)->delete();
            return redirect('/method');
        } else {
            return redirect('/dashboard');
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role == 1){
            $request->validate([
                'name' => ['required', 'string', 'max:255']
            ]);
            $input = $request->all();
            
            method::create($input);
            return redirect('/methods');
        } else {
            return redirect('/dashboard');
        }
    }
}
