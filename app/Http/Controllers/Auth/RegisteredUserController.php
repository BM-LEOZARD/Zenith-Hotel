<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
                'no_hp' => ['required', 'string', 'max:20', 'unique:users'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            event(new Registered($user));
            return redirect()->route('login')->with('register_success', 'Akun berhasil dibuat, silakan login!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('register_gagal', 'Registrasi gagal. Silakan coba lagi.');
        }
    }
}
