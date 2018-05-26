<?php

namespace App;

use App\Traits\HasCoordinatesTrait;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Challenge
 *
 * @package App
 * @property integer              id
 * @property integer|null         user_id
 * @property user|null            user
 * @property integer|null         level_id
 * @property level|null           level
 * @property Comment[]|Collection comments
 * @property User[]|Collection    users
 * @property Skill[]|Collection   skills
 * @property File[]|Collection    files
 * @property string               name
 * @property string               description
 * @property integer|null         reward_points
 * @property string|null          street
 * @property string|null          house_number
 * @property string|null          city
 * @property string|null          postal_code
 */
class Challenge extends Model
{
    use HasCoordinatesTrait, Filterable;

    public const STATUS_IN_REVIEW = 1;
    public const STATUS_OPEN = 2;
    public const STATUS_CLOSED = 3;
    public const STATUS_COMPLETED = 4;
    public const STATUSES = [
        self::STATUS_IN_REVIEW,
        self::STATUS_OPEN,
        self::STATUS_CLOSED,
        self::STATUS_COMPLETED,
    ];

    /** @var array */
    protected $fillable = [
        'level_id',
        'user_id',
        'name',
        'description',
        'reward_points',
        'street',
        'house_number',
        'city',
        'postal_code',
        'latitude',
        'longitude',
    ];

    // region RELATIONSHIPS  

    /**
     * @return BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    /**
     * @return HasMany
     */
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    // endregion

    // region SCOPES  

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
