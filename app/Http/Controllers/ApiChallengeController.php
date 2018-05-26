<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Http\Requests\ApiChallengeCompleteRequest;
use App\Http\Requests\ApiChallengeStoreRequest;
use App\Http\Requests\ApiChallengeUpdateRequest;
use App\Transformers\ChallengeTransformer;
use App\User;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class ApiChallengeController extends Controller
{
    /**
     * @param Request $request
     * @return Fractal
     */
    public function index(Request $request): Fractal
    {
        return fractal(Challenge::query()->filter($request->all())->get(), new ChallengeTransformer());
    }

    /**
     * @param ApiChallengeStoreRequest $request
     * @return Fractal
     */
    public function store(ApiChallengeStoreRequest $request): Fractal
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var Challenge $challenge */
        $challenge = $user->challenges()->create($request->validated());
        $challenge->skills()->attach($request->get('skills'));

        return fractal($challenge->fresh(), new ChallengeTransformer());
    }

    /**
     * @param ApiChallengeUpdateRequest $request
     * @param Challenge                 $challenge
     * @return Fractal
     */
    public function update(ApiChallengeUpdateRequest $request, Challenge $challenge): Fractal
    {
        $challenge->update($request->validated());

        return fractal($challenge->fresh(), new ChallengeTransformer());
    }

    /**
     * @param ApiChallengeCompleteRequest $request
     * @param Challenge                   $challenge
     * @return Fractal
     */
    public function complete(ApiChallengeCompleteRequest $request, Challenge $challenge): Fractal
    {
        $challenge->update(['status' => Challenge::STATUS_COMPLETED]);
        if ($challenge->reward_points) {
            /** @var User $user */
            $user = User::query()->find($request->get('user_id'));
            $user->update(['points' => $user->points + $challenge->reward_points]);
        }

        return fractal($challenge, new ChallengeTransformer());
    }
}
