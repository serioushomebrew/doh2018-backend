<?php

namespace App\Transformers;

use App\Level;
use League\Fractal\TransformerAbstract;

class LevelTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param Level $level
     * @return array
     */
    public function transform(Level $level): array
    {
        return [
            'id'          => $level->id,
            'points'      => $level->points,
            'verified'    => $level->points >= 500,
            'name'        => $level->name,
            'description' => $level->description,
            'image'       => $level->image,
        ];
    }
}
