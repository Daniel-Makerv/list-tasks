<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class TaskFileSeeder extends Seeder
{
    // $random_pdf = 
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $files_pdf = ['asd/asdf/asd.pdf', 'asd/asdf/ffff.pdf', 'asd/asdf/f.pdf', 'asd/asdf/df.pdf'];
        $files_jpg = ['asd/asdf/asd.jpg', 'asd/asdf/ffff.jpg', 'asd/asdf/f.jpg', 'asd/asdf/df.jpg'];


        Task::get()->map(function (Task $task) use ($files_pdf, $files_jpg) {
            if ($task->completed == true) {
                $task->completed_at = now();
                $task->save();
            }

            //llenando tareas con archivos pdf
            $random_pdf = rand(1, 4);
            for ($i = 0; $i < $random_pdf; $i++) {
                $task->files()->create([
                    'file_name' => Str::random(7) . '_' . $random_pdf,
                    'file_path' => $files_pdf[$i],
                    'file_type' => 'pdf',
                ]);
            }

            //llenando tareas con archivos jpg
            $random_jpg = rand(1, 4);
            for ($i = 0; $i < $random_jpg; $i++) {
                $task->files()->create([
                    'file_name' => Str::random(7) . '_' . $random_jpg,
                    'file_path' => $files_jpg[$i],
                    'file_type' => 'jpg',
                ]);
            }
        });
    }
}
