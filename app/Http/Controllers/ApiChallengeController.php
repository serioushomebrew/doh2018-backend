<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Http\Requests\ApiChallengeStoreRequest;
use App\Transformers\ChallengeTransformer;
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
        /** @var Challenge $challenge */
        $challenge = Challenge::query()->create($request->all());
        $challenge->skills()->attach($request->get('skills'));

        return fractal($challenge->fresh(), new ChallengeTransformer());
    }
}
