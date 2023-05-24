<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class c_login extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function akses(Request $request) 
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required'=>'Mohon mengisi form yang kosong!',
            'password.required'=>'Mohon mengisi form yang kosong!'
        ])->validate();        

        if (strpos($request->username, 'USR') !== false){
            if (!Auth::guard('web')->attempt($request->only(['username', 'password']))) {
                // throw ValidationException::withMessages([
                //     // 'username'=>trans('auth.failed')
                //     'username'=>'Username dan password tidak sesuai! Silahkan cek kembali!',
                // ]);
                return redirect()->route('login')->with('message', 'Username dan password tidak sesuai! Silahkan cek kembali!');
            }
            $request->session()->regenerate();
            return redirect()->route('beranda.usaha');
        }
        elseif (strpos($request->username, 'KRYWN') !== false) {
            if (!Auth::guard('karyawan')->attempt($request->only(['username', 'password']))){
                // throw ValidationException::withMessages([
                //     'username'=>'Username dan password tidak sesuai! Silahkan cek kembali!',
                // ]);
                return redirect()->route('login')->with('message', 'Username dan password tidak sesuai! Silahkan cek kembali!');
            }
            $request->session()->regenerate();
            return redirect()->route('beranda');
        }
        else{
            // throw ValidationException::withMessages([
            //     // 'username'=>trans('auth.failed')
            //     'username'=>'Username dan password tidak sesuai! Silahkan cek kembali!',
            // ]);
            return redirect()->route('login')->with('message', 'Username dan password tidak sesuai! Silahkan cek kembali!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/beranda');
    }

    public function mailResetForm(Request $request)
    {
        return view('auth.sendMail');
    }
    
    public function sendMailResetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);  
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:50|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
     
    }
}
