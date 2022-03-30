<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class users extends Controller
{
    public function showAll()
    {
        if (Auth::user()->role == 1){
            $users = User::all();
            return view('admin.users', ['users' => $users]);
        } else {
            return redirect('/dashboard');
        }
        
    }

    public function edit($id)
    {
        if (Auth::user()->role == 1){
            $user = User::find($id);
            return view('admin.edit', ['user' => $user]);
        } else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role == 1){
            $user = User::find($id);
            $input = $request->all();
            $user->update($input);
            return redirect('/users');
        } else {
            return redirect('/dashboard');
        }
    }

    public function deleteUser($id)
    {
        if (Auth::user()->role == 1){
            User::find($id)->delete();
            return redirect('/users');
        } else {
            return redirect('/dashboard');
        }
    }

    public function banUser($id)
    {
        if (Auth::user()->role == 1){
            $user = User::find($id);
            $user->update(['role' => '2']);
            return redirect('/users');
        } else {
            return redirect('/dashboard');
        }
    }
}
