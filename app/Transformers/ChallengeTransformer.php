<?php

namespace App\Transformers;

use App\Challenge;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ChallengeTransformer extends TransformerAbstract
{
    /** @var array */
    protected $availableIncludes = ['level', 'user', 'files', 'skills', 'comments'];

    /**
     * A Fractal transformer.
     *
     * @param Challenge $challenge
     * @return array
     */
    public function transform(Challenge $challenge): array
    {
        return [
            'id'            => $challenge->id,
            'name'          => $challenge->name,
            'description'   => $challenge->description,
            'reward_points' => $challenge->reward_points,
            'street'        => $challenge->street,
            'house_number'  => $challenge->house_number,
            'city'          => $challenge->city,
            'postal_code'   => $challenge->postal_code,
            'latitude'      => $challenge->latitude,
            'longitude'     => $challenge->longitude,
        ];
    }

    /**
     * @param Challenge $challenge
     * @return Item
     */
    public function includeLevel(Challenge $challenge): Item
    {
        return $this->item($challenge->level, new LevelTransformer());
    }

    /**
     * @param Challenge $challenge
     * @return Item
     */
    public function includeUser(Challenge $challenge): Item
    {
        return $this->item($challenge->user, new UserTransformer());
    }

    /**
     * @param Challenge $challenge
     * @return Collection
     */
    public function includeFiles(Challenge $challenge): Collection
    {
        return $this->collection($challenge->files, new FileTransformer());
    }

    /**
     * @param Challenge $challenge
     * @return Collection
     */
    public function includeSkills(Challenge $challenge): Collection
    {
        return $this->collection($challenge->skills, new SkillTransformer());
    }

    /**
     * @param Challenge $challenge
     * @return Collection
     */
    public function includeComments(Challenge $challenge): Collection
    {
        return $this->collection($challenge->comments, new CommentTransformer());
    }
}
