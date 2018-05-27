<?php

namespace App\Transformers;

use App\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    /** @var array */
    protected $availableIncludes = ['challenge', 'user_id'];

    /**
     * A Fractal transformer.
     *
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment): array
    {
        return [
            'id'          => $comment->id,
            'is_own'      => $comment->user_id === auth()->id(),
            'user_id'     => $comment->user_id,
            'description' => $comment->description,
        ];
    }
}
