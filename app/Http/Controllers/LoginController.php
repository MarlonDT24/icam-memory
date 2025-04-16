<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;


class LoginController extends Controller
{
    public function signupForm(): View
    {
        return view('auth.signup');
    }

    public function signup(SignupRequest $request): RedirectResponse
    {
        $user = new User();
        $user->username = $request->get('username');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        Auth::login($user);

        return redirect()->route('principal');
    }

    public function loginForm(): View|RedirectResponse
    {
        if (Auth::viaRemember()) {
            return 'Bienvenido de nuevo';
        } else if (Auth::check()) {
            return redirect()->route('principal');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request): View|RedirectResponse
    {
        $credentials = $request->only('username','password');

        if(Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('principal');
        } else {
            $error = 'Error al acceder a la aplicación';
            return view('auth.login', compact('error'));
        }
        /* /* $credentials = $request->validate([
            'username' => 'required|email',
            'password' => 'required',
        ]);
    
        $remember = $request->filled('remember'); 
    
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('users.account')->with('success', 'Inicio de sesión exitoso.');
        }
    
        return back()->withErrors(['email' => 'Las credenciales ingresadas no son correctas.'])->withInput(); */
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('principal');
    }
}
