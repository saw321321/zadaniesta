<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Logika logowania użytkownika, wykorzystując wbudowane mechanizmy Laravel.
    }

    public function logout(Request $request)
{
    Auth::logout();
    
    return redirect('/'); // Możesz przekierować użytkownika na dowolną stronę po wylogowaniu.
}

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Możesz dodać kod obsługujący zdarzenie po rejestracji, na przykład wysłanie powitalnego e-maila lub przekierowanie użytkownika.

        return redirect()->route('login')->with('success', 'Konto zostało utworzone. Możesz się teraz zalogować.');
    }



}