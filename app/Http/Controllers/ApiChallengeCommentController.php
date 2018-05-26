<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Http\Requests\ApiChallengeCommentStoreRequest;
use App\Transformers\CommentTransformer;
use Spatie\Fractal\Fractal;

class ApiChallengeCommentController extends Controller
{
    /**
     * @param ApiChallengeCommentStoreRequest $request
     * @param Challenge                       $challenge
     * @return Fractal
     */
    public function store(ApiChallengeCommentStoreRequest $request, Challenge $challenge): Fractal
    {
        $comment = $challenge->comments()->create(array_merge($request->all(), [
            'user_id' => auth()->id(),
        ]));

        return fractal($comment, new CommentTransformer());
    }
}
