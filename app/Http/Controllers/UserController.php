<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Admin;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $admins = Admin::with('user')->get();
        $lecturers = Lecturer::with('user')->get();
        $students = Student::with('user')->get();

        $admins->each(function ($admin) {
            $admin->user->role = 'Admin';
        });

        $lecturers->each(function ($lecturer) {
            $lecturer->user->role = 'Dosen';
        });

        $students->each(function ($student) {
            $student->user->role = 'Mahasiswa';
        });

        $users = $admins->merge($lecturers)->merge($students);

        $users = $users->sortByDesc(function ($user) {
            return $user->user->created_at;
        });

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

            switch ($request->role) {
                case 'Admin':
                    # code...
                    break;
            }

            $user = User::create([
                'name' => $request->name
            ]);

            return redirect()->route('dashboard.master.item.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }
}
