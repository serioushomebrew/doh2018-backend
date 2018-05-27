<?php

namespace App\Transformers;

use App\Level;
use App\User;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /** @var array */
    protected $availableIncludes = ['skills', 'challenges', 'current_level'];

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

    /**
     * @param User $user
     * @return Item
     */
    public function includeCurrentLevel(User $user): Item
    {
        if ($user->points === null) {
            $current_level = Level::query()->orderBy('points')->first();
        } else {
            $current_level = Level::query()->where('points', '<=', $user->points)->orderBy('points', 'desc')->first();
        }

        return $this->item($current_level, new LevelTransformer());
    }
}
