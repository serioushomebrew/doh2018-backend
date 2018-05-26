<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use App\User;
use Spatie\Fractal\Fractal;

class ApiUserController extends Controller
{
    /**
     * @return Fractal
     */
    public function index(): Fractal
    {
        return fractal(User::query()->get(), new UserTransformer());
    }
}
