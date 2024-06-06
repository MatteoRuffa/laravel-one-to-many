<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ottenere tutti i tipi disponibili
        $types = Type::all();

        // Iterare su tutti i progetti
        Project::chunk(100, function ($projects) use ($types) {
            foreach ($projects as $project) {
                // Assegnare casualmente un type_id tra quelli disponibili
                $randomType = $types->random();
                $project->type_id = $randomType->id;
                $project->save();

                // Stampa il nome associato al type_id
                echo "Project: {$project->title} - Type: {$randomType->name}\n";
            }
        });
    }
}

