<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Level
 *
 * @package App
 * @property integer id
 * @property integer     points
 * @property string      name
 * @property string      description
 * @property string|null image
 */
class Level extends Model
{
    use Filterable;

    /** @var array */
    protected $fillable = [
        'points',
        'name',
        'description',
        'image',
    ];

    // region RELATIONSHIPS  

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
