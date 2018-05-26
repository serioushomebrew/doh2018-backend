<?php

namespace App\Http\Controllers;

use App\Skill;
use App\Transformers\SkillTransformer;
use Spatie\Fractal\Fractal;

class ApiSkillController extends Controller
{
    /**
     * @return Fractal
     */
    public function index(): Fractal
    {
        return fractal(Skill::query()->get(), new SkillTransformer());
    }
}
