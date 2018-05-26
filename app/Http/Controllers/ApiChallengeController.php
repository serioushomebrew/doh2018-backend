<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Transformers\ChallengeTransformer;
use Spatie\Fractal\Fractal;

class ApiChallengeController extends Controller
{
    /**
     * @return Fractal
     */
    public function index(): Fractal
    {
        return fractal(Challenge::query()->get(), new ChallengeTransformer());
    }
}
