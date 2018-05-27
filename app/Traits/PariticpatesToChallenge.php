<?php

namespace App\Traits;

use App\Scopes\ParticipateToChallengeScope;

trait PariticpatesToChallenge
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    public static function bootBelongsToChallenge(): void
    {
        static::addGlobalScope(new ParticipateToChallengeScope());
    }
}
