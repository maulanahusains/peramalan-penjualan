<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.master-data.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required'],
            'level' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        DB::beginTransaction();
        try {
            $user = new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->level = $request->level;
            $user->save();

            DB::commit();
            return redirect()
                ->route('kelola.user.index')
                ->with('success', 'Sukses Menambah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('kelola.user.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()
                ->route('kelola.user.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        return view('pages.master-data.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            return redirect()
                ->route('kelola.user.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'username' => ['required', Rule::unique('users', 'username')->ignore($user->id)],
            'level' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        DB::beginTransaction();
        try {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = ($request->password) ? bcrypt($request->password) : $user->password;
            $user->level = $request->level;
            $user->save();

            DB::commit();
            return redirect()
                ->route('kelola.user.index')
                ->with('success', 'Sukses Mengubah Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('kelola.user.index')
                ->with('error', 'Something went wrong!');
        }
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();

        if (!$user) {
            return redirect()
                ->route('kelola.user.index')
                ->with('error', 'Data tidak ditemukan!');
        }

        DB::beginTransaction();
        try {
            $user->delete();

            DB::commit();
            return redirect()
                ->route('kelola.user.index')
                ->with('success', 'Sukses Menghapus Data!');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()
                ->route('kelola.user.index')
                ->with('error', 'Something went wrong!');
        }
    }
}
