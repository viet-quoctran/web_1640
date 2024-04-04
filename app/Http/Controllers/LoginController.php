<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role_id != $request->role) {
                Auth::logout();
                // Sử dụng abort(403) thay vì abort(404) để rõ ràng hơn về việc truy cập bị từ chối
                return abort(403, 'Access Denied due to role mismatch.');
            }

            return $this->redirectBasedOnRole($request->role);
        }

        // Đăng nhập thất bại
        return back()->withErrors(['error' => 'Email or password is incorrect.']);
    }

    protected function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 1:
                return redirect()->route('dashboard');
            case 2:
                return redirect()->route('home');
            default:
                // Sử dụng abort(403) nếu role không hợp lệ
                return abort(403, 'Access Denied.');
        }
    }
}
