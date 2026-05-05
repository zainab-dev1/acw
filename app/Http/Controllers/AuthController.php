<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        //LoginUsingId
        //Auth::loginUsingId(1);
        //return redirect()->route('dashboard.index');

        /** Check user if record exist on database */
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            //if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            $user = DB::table('users')->where('username', $request->username)->first();
            //dd($user);
            if ($user) {
            /* Record of user exist on database */
                /* Authenticate using LDAP */
                return redirect()->route('dashboard.index');

            } else {


                /* Redirect back to login */

                Alert::error('Contact Administrator', 'You do not have record on our database');

                return redirect()->route('login');

                // Check Invigilators table

            }
        } else {
                Alert::error('Login Error', 'invalid Credentials');

                return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('public');
    }

    public function loginas($id)
    {
        return view('loginas')->with('id', $id);
    }

    public function postloginas(Request $request, $id)
    {
        if ($request->password == '123') {
            Auth::loginUsingId($id);

            return redirect()->route('dashboard.index');
        }

        return redirect()->route('login');
    }

    // Forgot Password - Show form
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    // Send Reset Link Email
    public function sendResetLinkEmail(Request $request)
    {
        try {
            $request->validate(['email' => 'required|email']);

            // Check if user exists with this email
            $user = \App\Models\User::where('email', $request->email)->first();
            
            if (!$user) {
                Alert::error('خطأ', 'لم يتم العثور على مستخدم بهذا البريد الإلكتروني.');
                return back()->withInput();
            }

            // Delete old tokens for this email
            DB::table('password_resets')->where('email', $request->email)->delete();

            // Create new token
            $token = Str::random(60);
            
            // Store token in database
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => Hash::make($token),
                'created_at' => now()
            ]);

            // Create reset URL
            $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($request->email));
            
            // Send email
            Mail::to($user->email)->send(new ResetPasswordMail($resetUrl, $user->fullname));

            Alert::success('تم بنجاح', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.');
            return back();

        } catch (\Exception $e) {
            \Log::error('Password reset error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            Alert::error('خطأ', 'حدث خطأ أثناء إرسال البريد الإلكتروني: ' . $e->getMessage());
            return back();
        }
    }

    // Show Reset Password Form
    public function resetPassword($token, Request $request)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed',
            ]);

            // Find user
            $user = \App\Models\User::where('email', $request->email)->first();
            
            if (!$user) {
                Alert::error('خطأ', 'لم يتم العثور على مستخدم بهذا البريد الإلكتروني.');
                return back();
            }

            // Check token
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)
                ->first();

            if (!$tokenData) {
                Alert::error('خطأ', 'رمز إعادة تعيين كلمة المرور غير صالح أو منتهي الصلاحية.');
                return back();
            }

            // Check if token is valid (using Hash::check for hashed tokens)
            if (!Hash::check($request->token, $tokenData->token)) {
                Alert::error('خطأ', 'رمز إعادة تعيين كلمة المرور غير صحيح.');
                return back();
            }

            // Check if token is expired (60 minutes)
            $createdAt = \Carbon\Carbon::parse($tokenData->created_at);
            if ($createdAt->addMinutes(60)->isPast()) {
                Alert::error('خطأ', 'انتهت صلاحية رمز إعادة تعيين كلمة المرور.');
                return back();
            }

            // Update password
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(60);
            $user->save();

            // Delete token
            DB::table('password_resets')->where('email', $request->email)->delete();

            Alert::success('تم بنجاح', 'تم إعادة تعيين كلمة المرور بنجاح! يمكنك الآن تسجيل الدخول.');
            return redirect()->route('login');

        } catch (\Exception $e) {
            \Log::error('Password update error: ' . $e->getMessage());
            Alert::error('خطأ', 'حدث خطأ: ' . $e->getMessage());
            return back();
        }
    }
}