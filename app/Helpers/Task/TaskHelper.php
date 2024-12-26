<?php

namespace App\Helpers\Task;

use App\Models\Task;
use App\Models\TaskFile;
use Exception;

class TaskHelper
{
    /**
     * allTasks
     *
     * @param  mixed $paginate
     * @param  mixed $title
     * @return void
     */
    public static function allTasks($paginate, $title)
    {
        return Task::leftJoin('task_files', 'tasks.id', 'task_files.task_id')
            ->whereNull('tasks.deleted_at')
            ->where('tasks.title', 'LIKE', '%' . $title . '%')
            ->selectRaw("tasks.id as id, tasks.title as titleTask, tasks.description as descriptionTask, tasks.completed as completed, tasks.completed_at as completedAtTask,COUNT(task_files.id) as files_count")
            ->groupBy('tasks.id', 'tasks.title', 'tasks.description', 'tasks.completed', 'tasks.completed_at')
            ->paginate($paginate ?? 10);
    }

    /**
     * findTaskAndFilesById
     *
     * @param  string $id
     * @return mixed
     */
    public static function findTaskAndFilesById(int $id)
    {
        return Task::with('files')
            ->where('tasks.id', $id)
            ->whereNull('deleted_at')
            ->first();
    }

    /**
     * deleteTask
     *
     * @param  mixed $taskId
     * @return void
     */
    public static function deleteTask($taskId)
    {
        $task = Task::find($taskId)->delete();
    }

    /**
     * createTask
     *
     * @param  mixed $data
     * @return void
     */
    public static function createTask($data)
    {
        try {
            $task = Task::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'completed' => false,
                'completed_at' => null,
            ]);
            if ($data['files']) { //guardando archivos
                foreach ($data['files'] as $file) {
                    $path = $file->store('uploads', 'public'); // Guardar el archivo en 'storage/app/public/uploads'
                    TaskFile::create([
                        'task_id' => $task->id,
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'file_type' => $file->getClientOriginalExtension(),
                    ]);
                }
            }
        } catch (\Exception $err) {
            return throw new Exception("Error al guardar la tarea " . $err->getMessage(), 500);
        }
    }

    /**
     * completeTask
     *
     * @param  mixed $idTask
     * @return void
     */
    public static function completeTask(string $idTask)
    {
        try {
            $idTask = Task::where('id', $idTask)->firstOrFail();
            if ($idTask->completed == false) {
                $idTask->complete_task = true;
                $idTask->completed_at = now();
                $idTask->save();
            } else {
                $idTask->complete_task = false;
                $idTask->completed_at = null;
                $idTask->save();
            }
        } catch (\Exception $err) {
            return throw new Exception("Error al completar la tarea la tarea " . $err->getMessage(), 500);
        }
    }
}
