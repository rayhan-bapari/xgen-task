<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
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
            'email' => ['required', 'email'],
        ]);

        if ($request->ajax()) {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['errors' => ['email' => ["Email doesn't match our records."]]], 404);
            }
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($request->ajax()) {
            return $status == Password::RESET_LINK_SENT
                ? response()->json(['message' => __($status)], 200)
                : response()->json(['errors' => ['email' => __($status)]], 422);
        }

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
