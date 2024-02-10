<?php

namespace Database\Seeders;

use App\Constants\StatusUser;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminExists = User::where('username', 'admin')->exists();

        if ($adminExists) {
            return;
        }

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'status' => StatusUser::ACTIVE,
            'password' => Hash::make('admin')
        ]);

        Admin::create([
            'user_id' => $user->id
        ]);
    }
}
