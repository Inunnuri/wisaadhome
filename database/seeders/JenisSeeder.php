<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jenis;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenis::create(
            [
                'name' => 'Dijual',
            ]
            );
            Jenis::create(
                [
                    'name' => 'Disewakan',
                ]
                );
    }
}
