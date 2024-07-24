<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(
            [
                'name' => 'Rumah',
            'slug' => 'rumah',
            'color' => 'red',
            ]
            );
            Category::create(
                [
                    'name' => 'Kost',
                'slug' => 'kost',
                'color' => 'green',
                ]
                );
                Category::create(
                    [
                        'name' => 'Apartment',
                    'slug' => 'Apartment',
                    'color' => 'blue',
                    ]
                    );
                    Category::create(
                        [
                            'name' => 'Tanah',
                        'slug' => 'tanah',
                        'color' => 'yellow',
                        ]
                        );

    }
}
