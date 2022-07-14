<?php

namespace App\Observers;

use App\Events\TaskEvent;
use App\Models\Todo;
use Auth;

class TodoObserver
{
    /**
     * Handle the Todo "created" event.
     *
     * @param  \App\Models\Todo  $task
     * @return void
     */
    public function created(Todo $task)
    {
        $task->completed = false;
        broadcast(
            new TaskEvent('created', Auth::user(), request()->project, $task)
        )->toOthers();
    }

    /**
     * Handle the Todo "updated" event.
     *
     * @param  \App\Models\Todo  $task
     * @return void
     */
    public function updated(Todo $task)
    {
        broadcast(
            new TaskEvent('updated', Auth::user(), request()->project, $task)
        )->toOthers();
    }

    /**
     * Handle the Todo "deleted" event.
     *
     * @param  \App\Models\Todo  $task
     * @return void
     */
    public function deleted(Todo $task)
    {
        broadcast(
            new TaskEvent('deleted', Auth::user(), request()->project, $task)
        )->toOthers();
    }
}
