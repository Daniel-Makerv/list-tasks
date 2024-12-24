<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskFileSeeder extends Seeder
{
    // $random_pdf = 
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Task::get()->map(function (Task $task) {
            
        });
    }
}
