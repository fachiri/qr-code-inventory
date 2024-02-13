<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserAccountRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Admin;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('admin', 'lecturer', 'student')->get();

        return view('pages.user.index', compact('users'));
    }

    public function create(Request $request)
    {
        if (!$request->has('role') || !in_array($request->role, ['Admin', 'Lecturer', 'Student'])) {
            return redirect()->route('dashboard.user.create', ['role' => 'Student']);
        }

        return view('pages.user.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            if (!$request->has('role') || !in_array($request->role, ['Admin', 'Lecturer', 'Student'])) {
                return redirect()->route('dashboard.user.create', ['role' => 'Student']);
            }

            $modelClassName = 'App\Models\\' . $request->role;
            $model = new $modelClassName;

            switch ($request->role) {
                case 'Admin':
                    $username = $request->username;
                    break;

                case 'Lecturer':
                    $username = $request->nidn;
                    $model->nidn = $request->nidn;
                    break;

                case 'Student':
                    $username = $request->nim;
                    $model->nim = $request->nim;
                    break;
            }

            $user = User::create([
                'name' => $request->name,
                'username' => $username,
                'password' => $username
            ]);

            $model->user_id = $user->id;
            $model->save();

            return redirect()->route('dashboard.user.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(User $user)
    {
        return view('pages.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            if ($user->lecturer) {
                $user->lecturer->nidn = $request->nidn;
                $user->lecturer->jabatan = $request->jabatan;
                $user->lecturer->update();
            }

            if ($user->student) {
                $user->student->nim = $request->nim;
                $user->student->update();
            }

            $user->name = $request->name;
            $user->update();

            return redirect()->back()->with('success', 'Data telah diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function update_account(UpdateUserAccountRequest $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();

            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'status' => $request->status,
            ]);

            return redirect()->back()->with('success', 'Data telah diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
