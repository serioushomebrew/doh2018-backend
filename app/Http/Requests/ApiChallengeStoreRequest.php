<?php

namespace App\Http\Requests;

use App\Level;
use App\Skill;
use Illuminate\Foundation\Http\FormRequest;

class ApiChallengeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'level_id'      => ['exists:' . (new Level())->getTable() . ',id'],
            'name'          => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string'],
            'reward_points' => ['integer'],
            'street'        => ['string'],
            'house_number'  => ['string'],
            'city'          => ['string'],
            'postal_code'   => ['string'],
            'latitude'      => ['numeric'],
            'longitude'     => ['numeric'],
            'skills'        => ['array'],
            'skills.*'      => ['numeric', 'exists:' . (new Skill())->getTable() . ',id'],
        ];
    }
}
