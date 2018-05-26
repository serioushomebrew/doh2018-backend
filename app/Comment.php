<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Comment
 *
 * @package App
 * @property integer   id
 * @property User      user
 * @property integer   user_id
 * @property Challenge challenge
 * @property integer   challenge_id
 * @property string    description
 */
class Comment extends Model
{
    use Filterable;

    /** @var array */
    protected $fillable = [
        'user_id',
        'challenge_id',
        'description',
    ];

    // region RELATIONSHIPS  

    /**
     * @return BelongsTo
     */
    public function challenge(): BelongsTo
    {
        return $this->belongsTo(Challenge::class);
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
