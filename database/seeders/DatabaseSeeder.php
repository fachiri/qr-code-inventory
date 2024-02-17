<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(LecturerSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
