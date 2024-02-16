<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            (object) [
                'name' => 'Computer Hardware',
                'detail' => 'Perangkat Keras Komputer'
            ],
            (object) [
                'name' => 'Network Devices',
                'detail' => 'Perangkat Jaringan'
            ],
            (object) [
                'name' => 'Printers and Scanners',
                'detail' => 'Pencetak dan Pemindai'
            ],
            (object) [
                'name' => 'Projectors and Screens',
                'detail' => 'Proyektor dan Layar Proyeksi'
            ],
            (object) [
                'name' => 'Storage Devices',
                'detail' => 'Perangkat Penyimpanan Data'
            ],
            (object) [
                'name' => 'Input Devices',
                'detail' => 'Perangkat Input (Mouse, Keyboard)'
            ],
            (object) [
                'name' => 'Laboratory Equipment',
                'detail' => 'Perlengkapan Laboratorium'
            ],
            (object) [
                'name' => 'Security and Protection Equipment',
                'detail' => 'Perlengkapan Keamanan dan Perlindungan'
            ]
        ];

        foreach ($categories as $category) {
            $categoryExists = Category::where('name', $category->name)->exists();
            if (!$categoryExists) {
                Category::create([
                    'name' => $category->name,
                    'detail' => $category->detail,
                ]);
            }
        }
    }
}
