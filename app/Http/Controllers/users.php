<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function showProfile()
    {
        $user = user::find(Auth::user()->id);
        return view('dashboard.profile', ['user' => $user]);
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
            return redirect('/admin');
        } else {
            return redirect('/dashboard');
        }
    }

    public function selfupdate(Request $request)
    {
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'email' => ['required', 'email'],
            'new_confirm_password' => ['same:new_password']
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password), 'email'=> $request->email]);
        return redirect('/profile');
    }

    public function deleteUser($id)
    {
        if (Auth::user()->role == 1){
            User::find($id)->delete();
            return redirect('/admin');
        } else {
            return redirect('/dashboard');
        }
    }

    public function banUser($id)
    {
        if (Auth::user()->role == 1){
            $user = User::find($id);
            $user->update(['role' => '2']);
            return redirect('/admin');
        } else {
            return redirect('/dashboard');
        }
    }
}
