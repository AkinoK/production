<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     */
    public function store(LoginRequest $request): RedirectResponse
    {
    $request->authenticate();

    $request->session()->regenerate();
    
    // ログインしている人の情報を取得
    $user = Auth::user();
    
    // rolesはUser.phpのrolesメソッドから取得
    // 中間テーブルのuser_rolesのrole_idが 'staff' （1）の場合
    $user_roles = $user->user_roles()->where('role_id', '1')->get();

    if ($user_roles->isNotEmpty()) {
        return redirect(RouteServiceProvider::HOME);
    }
    
    // role_idが 'family'（2） の場合
    $user_roles = $user->user_roles()->where('role_id', '2')->get();
    
    if ($user_roles->isNotEmpty()) {
        return redirect(RouteServiceProvider::HOMEFAMILY);
    }

    // 上記のいずれの条件にも該当しない場合のデフォルトのリダイレクト
    return redirect()->route('login')->with('error', 'ログインできません。');
}
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}