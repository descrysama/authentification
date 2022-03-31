<?php

namespace App\Http\Controllers;

use App\Models\plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class planController extends Controller
{
    public function showAll() {
        $plans = plan::all();
        return view('dashboard.purchase', ['plans' => $plans]);
    }

    public function listAll() {
        $plans = plan::all();
        return view('admin.plans', ['plans' => $plans]);
    }

    public function edit($id)
    {
        if (Auth::user()->role == 1){
            $plan = plan::find($id);
            return view('admin.editplan', ['plan' => $plan]);
        } else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 1){
            $plan = plan::find($id);
            $input = $request->all();
            $plan->update($input);
            return redirect('/plans');
        } else {
            return redirect('/dashboard');
        }
    }

    public function deletePlan($id)
    {
        if (Auth::user()->role == 1){
            plan::find($id)->delete();
            return redirect('/plans');
        } else {
            return redirect('/dashboard');
        }
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role == 1){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'price' => ['required', 'integer'],
                'length' => ['required', 'integer'],
                'days' => ['required', 'integer']
            ]);
            $input = $request->all();
            
            plan::create($input);
            return redirect('/plans');
        } else {
            return redirect('/dashboard');
        }
    }
}
