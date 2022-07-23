<?php

namespace App\Events\ProjectTeam;

use App\Models\Project;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class AbstractUserToProjectTeam implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $project_slug;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public User $user, protected Project $project, public ?string $bladeComponent = null)
    {
        $this->project_slug = $project->slug;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel(
            'project.'.$this->project->slug.'.tasks'
        );
    }
}
