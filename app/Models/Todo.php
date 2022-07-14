<?php

namespace App\Models;

use Auth;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    use BroadcastsEvents;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body', 'completed'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'project_id' => 'integer',
        'completed' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the channels that model events should broadcast on.
     *
     * @param  string  $event
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn($event)
    {
        return new PresenceChannel(
            'project.' . request()->project->slug . '.tasks'
        );
    }

    /**
     * Get the data to broadcast for the model.
     *
     * @param  string  $event
     * @return array
     */
    public function broadcastWith($event)
    {
        return [
            'type' => $event,
            'task' => $this,
            'user' => Auth::user(),
        ];
    }

    /**
     * The model event's broadcast name.
     *
     * @param  string  $event
     * @return string|null
     */
    public function broadcastAs($event)
    {
        return 'TaskEvent';
    }
}
