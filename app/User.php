<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package App
 * @property integer id
 * @property string  name
 * @property string  email
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
