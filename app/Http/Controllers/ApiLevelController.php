<?php

namespace App\Http\Controllers;

use App\Level;
use App\Transformers\LevelTransformer;
use Spatie\Fractal\Fractal;

class ApiLevelController extends Controller
{
    /**
     * @return Fractal
     */
    public function index(): Fractal
    {
        return fractal(Level::query()->get(), new LevelTransformer());
    }
}
