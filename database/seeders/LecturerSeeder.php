<?php

namespace Database\Seeders;

use App\Constants\StatusUser;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LecturerSeeder extends Seeder
{
    public function run(): void
    {
        $lecturerExists = User::where('username', '0031037903')->exists();

        if ($lecturerExists) {
            return;
        }

        $user = User::create([
            'name' => 'Rahman Takdir, S.Kom, M.Cs',
            'username' => '0031037903',
            'status' => StatusUser::ACTIVE,
            'password' => Hash::make('0031037903')
        ]);

        Lecturer::create([
            'user_id' => $user->id,
            'nidn' => $user->username
        ]);
    }
}
