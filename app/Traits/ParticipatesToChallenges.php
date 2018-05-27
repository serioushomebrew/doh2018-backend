<?php

namespace App\Traits;

use App\Scopes\ParticipateToChallengesScope;

trait ParticipatesToChallenges
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    public static function bootBelongsToChallenges(): void
    {
        static::addGlobalScope(new ParticipateToChallengesScope());
    }
}
