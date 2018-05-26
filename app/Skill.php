<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * Class Skill
 *
 * @package App
 * @property integer                id
 * @property string                 name
 * @property User[]|Collection      users
 * @property Challenge[]|Collection challenges
 */
class Skill extends Model
{
    use Filterable;

    /** @var array */
    protected $fillable = [
        'name',
    ];

    // region RELATIONSHIPS  

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
    public function challenges(): BelongsToMany
    {
        return $this->belongsToMany(Challenge::class);
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
