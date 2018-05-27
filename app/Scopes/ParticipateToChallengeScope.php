<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ParticipateToChallengeScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder $builder
     * @param  Model   $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {
            $builder->whereHas('challenge.users', function (Builder $builder) {
                return $builder->where('id', auth()->id())->whereNotNull('accepted_at', null);
            });
        }
    }
}
