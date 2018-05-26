<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Challenge
 *
 * @package App
 * @property integer      id
 * @property integer|null user_id
 * @property user|null    user
 * @property string       name
 * @property string       description
 * @property integer|null level_id
 * @property level|null   level
 */
class Challenge extends Model
{
    /** @var array */
    protected $fillable = [
        'level_id',
        'user_id',
        'name',
        'description',
    ];

    // region RELATIONSHIPS  

    /**
     * @return BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
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
