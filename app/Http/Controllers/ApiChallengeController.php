<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Http\Requests\ApiChallengeStoreRequest;
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
        $challenge = $user->challenges()->create($request->all());

        $ac = new AddressesController;
        $addressApi = $ac->checkZipcode($challenge->postal_code, $challenge->house_number);
        $challenge->latitude = $addressApi['lat'];
        $challenge->longitude = $addressApi['long'];
        $challenge->city = $addressApi['city'];
        $challenge->street = $addressApi['street'];
        $challenge->save();


        $challenge->skills()->attach($request->get('skills'));

        return fractal($challenge->fresh(), new ChallengeTransformer());
    }
}
