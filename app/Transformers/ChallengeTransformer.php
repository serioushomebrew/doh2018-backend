<?php

namespace App\Transformers;

use App\Challenge;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ChallengeTransformer extends TransformerAbstract
{
    /** @var array */
    protected $availableIncludes = ['level', 'user', 'files', 'skills', 'comments', 'requests', 'participants'];

    /**
     * A Fractal transformer.
     *
     * @param Challenge $challenge
     * @return array
     */
    public function transform(Challenge $challenge): array
    {
        $connected_to_issue = true;
//        $connected_to_issue = $challenge->users()
//            ->wherePivot('accepted_at', '!=', null)
//            ->where('id', auth()->id())
//            ->exists();

        return [
            'id'            => $challenge->id,
            'status'        => $challenge->status,
            'status_name'   => $this->getStatusName($challenge),
            'name'          => $challenge->name,
            'description'   => $challenge->description,
            'reward_points' => $challenge->reward_points,
            'reward_gift'   => $challenge->reward_gift,
            'street'        => $connected_to_issue ? $challenge->street : null,
            'house_number'  => $connected_to_issue ? $challenge->house_number : null,
            'city'          => $connected_to_issue ? $challenge->city : null,
            'postal_code'   => $connected_to_issue ? $challenge->postal_code : null,
            'latitude'      => $connected_to_issue ? $challenge->latitude : null,
            'longitude'     => $connected_to_issue ? $challenge->longitude : null,
        ];
    }

    /**
     * @param Challenge $challenge
     * @return string
     */
    protected function getStatusName(Challenge $challenge): string
    {
        switch ($challenge->status) {
            case Challenge::STATUS_IN_REVIEW:
                return 'in review';
            case Challenge::STATUS_OPEN :
                return 'open';
            case Challenge::STATUS_CLOSED:
                return 'closed';
            case Challenge::STATUS_COMPLETED:
                return 'completed';
        }

        return '';
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

    /**
     * @param Challenge $challenge
     * @return Collection
     */
    public function includeRequests(Challenge $challenge): Collection
    {
        $requests = $challenge->users()->wherePivot('accepted_at', null)->get();

        return $this->collection($requests, new UserTransformer());
    }

    /**
     * @param Challenge $challenge
     * @return Collection
     */
    public function includeParticipants(Challenge $challenge): Collection
    {
        $participants = $challenge->users()->wherePivot('accepted_at', '!=', null)->get();

        return $this->collection($participants, new UserTransformer());
    }
}
