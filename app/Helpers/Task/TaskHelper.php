<?php

namespace App\Helpers\Task;

use App\Models\Task;

class TaskHelper
{
    public static function allTasks()
    {
        return Task::leftJoin('task_files', 'tasks.id', 'task_files.task_id')
            ->whereNull('tasks.deleted_at')
            ->groupBy('tasks.id', 'tasks.name', 'tasks.description', 'tasks.completed', 'tasks.completed_at')
            ->selectRaw('tasks.id as id, tasks.name as nameTask, tasks.description as descriptionTask,tasks.completed, tasks.completed_at as completedAtTask,COUNT(task_files.id) as files_count')
            ->get();
    }

    public static function findTaskAndFilesById(int $id)
    {
        return Task::with('files')
            ->where('tasks.id', $id)
            ->whereNull('deleted_at')
            ->first();
    }
}
