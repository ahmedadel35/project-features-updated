<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Todo;
use Illuminate\Http\Request;

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
        if (request()->wantsJson()) {
            $tasks = Todo::where('project_id', $project->id)
            ->orderByDesc('updated_at')
            ->simplePaginate();

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

        /**
         * why not using observer here?
         * because we can not access project instance into observer
         * so we will always (re)fetch project from database
         * to check if it was already completed before
         */
        $this->updateProjectIfCompleted($project);

        return response()->json($task, 201);
    }

    /**
     * toggle the state of task
     *
     * @param  Request  $request
     * @param  Category  $category
     * @param  Project  $project
     * @param  Todo  $task
     * @return void
     */
    public function toggle(
        Request $request,
        Category $category,
        Project $project,
        Todo $task
    ) {
        /**
         * this should not go to observer
         * because we do not want to run this check
         * for normal task body update
         * bu instead for the completed state toggle only
         */
        ['completed' => $completed] = $request->validate([
            'completed' => 'required|boolean',
        ]);

        $task->update(compact('completed'));

        // check if user was completeing task or not
        if (! $completed) {
            // user un checked this task
            // then remove completed state from project if exists

            return response()->json([
                'project_completed' => $this->updateProjectIfCompleted(
                    $project
                ),
            ]);
        }
        //else

        // determine if all project tasks was completed or not
        $project_completed = $project->completed;
        $tasks = Todo::whereProjectId($project->id);
        $checked = Todo::whereProjectId($project->id)->whereCompleted(true);
        if ($tasks->count() === $checked->count()) {
            // update project state to completed
            $project->update(['completed' => true]);
            $project_completed = true;
        } else {
            // check if project was completed
            $project_completed = $this->updateProjectIfCompleted($project);
        }

        return response()->json(compact('project_completed'));
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

    /**
     * remove completed state from project if exists
     *
     * @param  Project  $project
     * @return void
     */
    private function updateProjectIfCompleted(Project $project): bool
    {
        if (! $project->completed) {
            return false;
        }

        // then update to not completed
        $project->update(['completed' => false]);

        return false;
    }
}
