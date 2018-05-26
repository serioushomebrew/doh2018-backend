<?php namespace App\ModelFilters;

use App\Traits\GeoFilterTrait;
use EloquentFilter\ModelFilter;

class ChallengeFilter extends ModelFilter
{
    use GeoFilterTrait;

    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];
}
