<?php

namespace App\Models;

use Hashids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'changed_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'changed_password',
        'email',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'changed_password' => 'boolean',
    ];

    protected $appends = ['id_hash'];

    protected function idHash(): Attribute
    {
        return Attribute::make(
            get: fn ($val, $attr) => Hashids::encode($attr['id'])
        )->shouldCache();
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn ($val, $attr) => null !== $attr['avatar']
                ? $attr['avatar']
                : url('/users/admin.jpeg')
        );
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Project::class, Category::class);
    }

    public function todos()
    {
        return $this->hasManyDeep(Todo::class, [
            Category::class,
            Project::class,
        ]);
    }
}
