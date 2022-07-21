<?php

use App\Models\Project;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('project.{project}.tasks', function (
    $user,
    Project $project
) {
    if( (int) $project->category->user_id === (int) $user->id ||
        $project->isTeamMember($user)) {
            return $user->only(['name', 'avatar', 'id_hash']);
        }
    return false;
});
