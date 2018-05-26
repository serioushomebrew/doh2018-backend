<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class File
 *
 * @package App
 * @property int         id
 * @property string      name
 * @property string|null description
 * @property string      size
 * @property integer     challenge_id
 * @property Challenge   challenge
 */
class File extends Model
{
    /** @var array */
    protected $fillable = [
        'challenge_id',
        'description',
        'size',
        'size',
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
