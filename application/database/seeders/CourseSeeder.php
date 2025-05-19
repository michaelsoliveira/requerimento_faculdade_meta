<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Course::where('name', 'Sistemas Para Internet')->first()) {
            Course::create([
                'name' => 'Sistemas Para Internet',
                'description' => 'focado em desenvolvimento web'
            ]);
        }

        if (!Course::where('name', 'Redes de Computadores')->first()) {
            Course::create([
                'name' => 'Redes de Computadores',
                'description' => 'focado em redes de computadores e computação distribuida'
            ]);
        }
    }
}
