<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request -> validate ([
            'loginname' => 'required', 'loginpassword' => 'required'
        ]);
        if (auth()->attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
        }

        
        return redirect('/'); // redirect to home page
    }

  public function register(Request $request) {
    $incomingFields = $request->validate([
        'name' => ['required', 'min:1', 'max:100', Rule::unique('users', 'name')],
        'email' => ['required', 'email', Rule::unique('users', 'email')],
        'password' => ['required', 'min:1', 'max:200']
    ]);

    $incomingFields['password'] = bcrypt($incomingFields['password']);
    $user = User::create($incomingFields);
    auth()->login($user);

    // Registration successful, redirect to the home page with success message
    return redirect('/')->with('success', 'Registration successful. You are now logged in.');
}

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
