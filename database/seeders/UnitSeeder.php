<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            (object) [
                'name' => 'Unit',
                'detail' => 'Satuan'
            ],
            (object) [
                'name' => 'Box',
                'detail' => 'Kotak'
            ],
            (object) [
                'name' => 'Dozen',
                'detail' => 'Lusin'
            ],
            (object) [
                'name' => 'Set',
                'detail' => 'Set'
            ],
            (object) [
                'name' => 'Pair',
                'detail' => 'Pasang'
            ],
            (object) [
                'name' => 'Meter',
                'detail' => 'Meter'
            ],
            (object) [
                'name' => 'Kilogram',
                'detail' => 'Kilogram'
            ],
            (object) [
                'name' => 'Liter',
                'detail' => 'Liter'
            ],
            (object) [
                'name' => 'Roll',
                'detail' => 'Gulung'
            ],
            (object) [
                'name' => 'Sheet',
                'detail' => 'Lembar'
            ],
        ];

        foreach ($units as $unit) {
            $unitExists = Unit::where('name', $unit->name)->exists();
            if (!$unitExists) {
                Unit::create([
                    'name' => $unit->name,
                    'detail' => $unit->detail,
                ]);
            }
        }
    }
}
