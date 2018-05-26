<?php

namespace App\Transformers;

use App\User;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /** @var array */
    protected $availableIncludes = ['skills', 'challenges'];

    /**
     * A Fractal transformer.
     *
     * @param User $user
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id'          => $user->id,
            'points'      => $user->points,
            'name'        => $user->name,
            'description' => $user->description,
            'email'       => $user->email,
            'latitude'    => $user->latitude,
            'longitude'   => $user->longitude,
        ];
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function includeSkills(User $user): Collection
    {
        return $this->collection($user->skills, new SkillTransformer());
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function includeChallenges(User $user): Collection
    {
        return $this->collection($user->challenges, new ChallengeTransformer());
    }
}
