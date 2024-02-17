<?php

namespace Database\Seeders;

use App\Constants\StatusUser;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $studentExists = User::where('username', '531420003')->exists();

        if ($studentExists) {
            return;
        }

        $user = User::create([
            'name' => 'Muh. Fachry J.K. Luid',
            'username' => '531420003',
            'status' => StatusUser::ACTIVE,
            'password' => Hash::make('531420003')
        ]);

        Student::create([
            'user_id' => $user->id,
            'nim' => $user->username
        ]);
    }
}
