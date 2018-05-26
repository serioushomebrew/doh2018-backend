<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class ApiUserController extends Controller
{
    /**
     * @param Request $request
     * @return Fractal
     */
    public function index(Request $request): Fractal
    {
        return fractal(User::query()->filter($request->all())->get(), new UserTransformer());
    }
}
