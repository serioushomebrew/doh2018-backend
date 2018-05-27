<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Http\Requests\ApiChallengeAcceptParticipateRequest;
use App\Http\Requests\ApiChallengeCompleteRequest;
use App\Http\Requests\ApiChallengeStoreRequest;
use App\Http\Requests\ApiChallengeUpdateRequest;
use App\Level;
use App\Transformers\ChallengeTransformer;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\JsonResponse;
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
        $data = $request->validated();
        if (!array_key_exists('level_id', $data)) {
            /** @var Level $level */
            $level = Level::query()->orderBy('points')->first();
            $data['level_id'] = $level->id;
        }
        $challenge = $user->challenges()->create($data);

        (new AddressesController())->updateChallenge($challenge);

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
        (new AddressesController())->updateChallenge($challenge);

        return fractal($challenge->fresh(), new ChallengeTransformer());
    }

    /**
     * @param ApiChallengeCompleteRequest $request
     * @param Challenge                   $challenge
     * @return array
     */
    public function complete(ApiChallengeCompleteRequest $request, Challenge $challenge): array
    {
        $challenge->update(['status' => Challenge::STATUS_COMPLETED]);

        /** @var User $user */
        $user = User::query()->find($request->get('user_id'));

        if ($challenge->reward_points) {
            $user->update(['points' => $user->points + $challenge->reward_points]);

            $officer = (new PolitieApiController())->localOfficerArray($challenge->latitude,$challenge->longitude);

            dd($officer);

            if(!empty($officer['naam'])){
                (new SMSController())
                    ->send('Hallo '.$officer['naam'].', De gebruiker '.$user->name.' heeft het hoogste level gehaald. Je kunt contact met hem opnemen voor het screenen.','+31631348757');
            }
        }

        return [
            'challenge'  => fractal($challenge, new ChallengeTransformer()),
            'user'       => fractal($user, new UserTransformer()),
            'leveled_up' => true,
        ];
    }

    /**
     * @param Challenge $challenge
     * @return JsonResponse
     */
    public function participate(Challenge $challenge): JsonResponse
    {
        $challenge->users()->attach(auth()->user());

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * @param ApiChallengeAcceptParticipateRequest $request
     * @param Challenge                            $challenge
     * @return JsonResponse
     */
    public function acceptParticipate(ApiChallengeAcceptParticipateRequest $request, Challenge $challenge): JsonResponse
    {
        $challenge->users()->syncWithoutDetaching([
            $request->get('user_id') => ['accepted_at' => now()],
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}
