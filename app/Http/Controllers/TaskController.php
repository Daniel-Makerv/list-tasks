<?php

namespace App\Http\Controllers;

use App\Helpers\Task\TaskHelper;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\Task as TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginate = request('paginate') ?? 10;
        $searchTitle = request('search_title') ?? '';
        $tasks = TaskHelper::allTasks($paginate, $searchTitle);
        return inertia()->render('Task/Index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia()->render('Task/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest\Task $request)
    {
        try {
            TaskHelper::createTask($request->all());
        } catch (\Throwable $err) {
            // dd($err->getMessage());
            return redirect()->back()->withErrors('alert', 'errores');
        }
        return redirect()->route('task.index')->with('alert', 'Tarea creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $task = TaskHelper::deleteTask($id);
        } catch (\Exception $err) {
            return redirect()->route('task.index')->with('alert', 'Error Exitosa');
        }
        return redirect()->route('task.index')->with('alert', 'Eliminacíon Exitosa');
    }
}
