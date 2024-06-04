<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('login')
                ->withErrors($validator->errors());
        }

        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()
                ->route('dashboard');
        }

        return redirect()
            ->route('login')
            ->with('error', 'Username atau Password anda salah!');
    }

    public function check_to_reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username_recovery' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('login')
                ->withErrors($validator->errors());
        }

        $user = User::where('username', $request->username_recovery)->first();

        if (!$user || $user == null) {
            return redirect()
                ->route('login')
                ->with('error', 'Username tidak ditemukan!');
        }
        return redirect()
            ->route('view-reset-password', ['id' => encrypt($user->id)]);
    }

    public function view_reset_password(Request $request)
    {
        $user = User::where('id', decrypt($request->id))->first();
        $user->encrypted_id = encrypt($user->id);

        return view('auth.reset-pass', compact('user'));
    }

    public function reset_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required',
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        if ($validator->fails()) {
            $user = User::where('id', decrypt($request->id))->first();
            return redirect()
                ->route('view-reset-password', ['id' => encrypt($user->id)])
                ->withErrors($validator->errors());
        }

        $user = User::where('id', decrypt($request->id))->first();

        DB::beginTransaction();
        try {
            $user->password = bcrypt($request->new_password);
            $user->save();

            DB::commit();
            return redirect()
                ->route('login')
                ->with('success', 'Sukses Mengubah Password, silahkan login kembali!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('login')
                ->with('error', 'Ada yang salah, silahkan hubungi admin!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()
            ->route('login');
    }
}
