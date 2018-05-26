<?php

namespace App\Http\Controllers;

use App\Skill;
use App\Transformers\SkillTransformer;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class ApiSkillController extends Controller
{
    /**
     * @param Request $request
     * @return Fractal
     */
    public function index(Request $request): Fractal
    {
        return fractal(Skill::query()->filter($request->all())->get(), new SkillTransformer());
    }
}
