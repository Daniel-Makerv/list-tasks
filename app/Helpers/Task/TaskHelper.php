<?php

namespace App\Helpers\Task;

use App\Models\Task;

class TaskHelper
{
    public static function allTasks($paginate, $title)
    {
        return Task::leftJoin('task_files', 'tasks.id', 'task_files.task_id')
            ->whereNull('tasks.deleted_at')
            ->where('tasks.title', 'LIKE', '%' . $title . '%')
            ->selectRaw("tasks.id as id, tasks.title as titleTask, tasks.description as descriptionTask, tasks.completed as completed, tasks.completed_at as completedAtTask,COUNT(task_files.id) as files_count")
            ->groupBy('tasks.id', 'tasks.title', 'tasks.description', 'tasks.completed', 'tasks.completed_at')
            ->paginate($paginate ?? 10);
    }

    public static function findTaskAndFilesById(int $id)
    {
        return Task::with('files')
            ->where('tasks.id', $id)
            ->whereNull('deleted_at')
            ->first();
    }

    public static function deleteTask($taskId)
    {
        $task = Task::find($taskId)->delete();
    }
}
