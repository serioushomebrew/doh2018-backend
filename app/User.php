<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

/**
 * Class User
 *
 * @package App
 * @property integer            id
 * @property integer|null       points
 * @property string             name
 * @property string             description
 * @property string             email
 * @property Skill[]|Collection skills
 */
class User extends Authenticatable
{
    use Notifiable;

    public const TYPE_USER = 1;
    public const TYPE_HACKER = 2;
    public const TYPE_ADVISER = 3;
    public const TYPES = [
        self::TYPE_USER,
        self::TYPE_HACKER,
        self::TYPE_ADVISER,
    ];

    /** @var array */
    protected $fillable = [
        'points',
        'name',
        'description',
        'email',
        'password',
    ];

    /** @var array */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // region RELATIONSHIPS  

    /**
     * @return BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    // endregion

    // region SCOPES  

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeHackers(Builder $builder): Builder
    {
        return $builder->where('type', self::TYPE_HACKER);
    }

    // endregion

    // region MUTATORS  

    // endregion

    // region ACCESSORS  

    // endregion

    // region METHODS  

    // endregion

    // region STATIC METHODS  

    // endregion

}
