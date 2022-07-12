<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Todo;
use Blade;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use View;

class TodoController extends Controller
{
    const VALIDATION_RULES = [
        'body' => 'required|string|min:1|max:255',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, Project $project)
    {
        $tasks = Todo::where('project_id', $project->id)
            ->orderByDesc('updated_at')
            ->simplePaginate();

        if (request()->wantsJson()) {
            return response()->json(compact('tasks'));
        }

        return view('task.index', compact('category', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Category $category,
        Project $project
    ) {
        $task = $project
            ->todos()
            ->create($request->validate(self::VALIDATION_RULES));

        $task->completed = false;
        return response()->json($task, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $task
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Category $category,
        Project $project,
        Todo $task
    ) {
        $task->update($request->validate(self::VALIDATION_RULES));

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Project $project, Todo $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
