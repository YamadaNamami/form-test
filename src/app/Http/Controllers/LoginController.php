<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        logger('Request class: ' . get_class($request));
        logger('Before validation'); // ログ追加
        $validated = $request->validated(); // バリデーション実行

        logger('After validation'); // ログ追加
    logger('Validated Data: ', $validated); // ログ追加

        // 認証処理
        if (Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ])) {
            return redirect()->intended(Fortify::redirects('login'));
        }

        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }
}
