<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'Admin') {
                return redirect()->route('admin.dashboard')->with('login_success', 'Anda berhasil login sebagai Admin!');
            }
            if ($user->role === 'Customer') {
                return redirect()->route('index')->with('login_success', 'Anda berhasil login!');
            }
            Auth::logout();
            return back()->with('login_error', 'Role pengguna tidak dikenali.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->with('login_error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('logout', 'Anda telah berhasil logout.');
    }
}
