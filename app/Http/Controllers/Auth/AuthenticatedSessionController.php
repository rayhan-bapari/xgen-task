<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
     *
     * @throws ValidationException
     * @return RedirectResponse|JsonResponse
     */
    
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('username', $request->email)
            ->first();

        if (!$user || !Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            if ($request->ajax()) {
                return response()->json(['errors' => ['email' => ['Invalid credentials.']]], 422);
            }
            throw ValidationException::withMessages(['email' => 'Invalid credentials.']);
        }

        $request->session()->regenerate();

        if ($request->ajax()) {
            return response()->json(['message' => 'Login successful! Redirecting to dashboard...'], 200);
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
