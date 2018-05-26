<?php

namespace App\Http\Controllers;

use App\Level;
use App\Transformers\LevelTransformer;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class ApiLevelController extends Controller
{
    /**
     * @param Request $request
     * @return Fractal
     */
    public function index(Request $request): Fractal
    {
        return fractal(Level::query()->filter($request->all())->get(), new LevelTransformer());
    }
}
