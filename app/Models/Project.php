<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Cviebrock\EloquentSluggable\Sluggable;
use DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Znck\Eloquent\Traits\BelongsToThrough;

class Project extends Model
{
    use HasFactory;
    use Sluggable, BelongsToThrough;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'cost', 'info', 'completed'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cost' => 'float',
        'completed' => 'boolean',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function owner()
    {
        return $this->belongsToThrough(User::class, Category::class);
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function addToTeam(User $user): void
    {
        $this->team()->attach($user);
    }

    public function isTeamMember(User $user): bool
    {
        return DB::table('project_user')
            ->where('project_id', $this->id)
            ->where('user_id', $user->id)
            ->exists();
    }
}
