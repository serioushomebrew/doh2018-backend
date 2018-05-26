<?php

namespace App\Transformers;

use App\Skill;
use App\User;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class SkillTransformer extends TransformerAbstract
{
    /** @var array */
    protected $availableIncludes = ['users', 'challenges'];

    /**
     * A Fractal transformer.
     *
     * @param Skill $skill
     * @return array
     */
    public function transform($skill): array
    {
        return [
            'id'   => $skill->id,
            'name' => $skill->name,
        ];
    }

    /**
     * @param Skill $skill
     * @return Collection
     */
    public function includeUsers(Skill $skill): Collection
    {
        return $this->collection($skill->users, new UserTransformer());
    }

    /**
     * @param Skill $skill
     * @return Collection
     */
    public function includeChallenges(Skill $skill): Collection
    {
        return $this->collection($skill->challenges, new ChallengeTransformer());
    }
}
