<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function show(Request $request): View
    {
        $authMode = session('authMode') ?? ($request->string('mode')->toString() === 'register' ? 'register' : 'login');
        
        return view('auth', [
            'authMode' => $authMode,
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'email' => 'Las credenciales no coinciden con nuestros registros.',
                ])
                ->withInput($request->only('email', 'remember'))
                ->with('authMode', 'login');
        }

        $request->session()->regenerate();

        return redirect()
            ->route('auth.show')
            ->with('status', 'Sesion iniciada correctamente.');
    }

    public function register(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            'email.unique' => 'Este correo ya está registrado en nuestra base de datos.',
            'password.confirmed' => 'Sus contraseñas tienen que coincidir.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('name', 'email'))
                ->with('authMode', 'register');
        }

        $data = $validator->validated();

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('auth.show')
            ->with('status', 'Cuenta Creada!')
            ->with('status_style', 'created');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.show')
            ->with('status', 'Sesion cerrada correctamente.');
    }
}
