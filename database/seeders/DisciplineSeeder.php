<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Discipline;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Discipline::where('name', 'Banco de Dados 1')->first()) {
            Discipline::create([
                'name' => 'Banco de Dados 1',
                'description' => 'voltado para a disciplina de Banco de Dados 1',
                'course_id' => 1
            ]);
        }

        if (!Discipline::where('name', 'Banco de Dados 2')->first()) {
            Discipline::create([
                'name' => 'Banco de Dados 2',
                'description' => 'voltado para a disciplina de Banco de Dados 2',
                'course_id' => 2
            ]);
        }
    }
}
