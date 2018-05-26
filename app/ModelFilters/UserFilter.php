<?php namespace App\ModelFilters;

use App\Traits\GeoFilterTrait;
use App\User;
use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    use GeoFilterTrait;

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param mixed $type
     * @return void
     */
    public function type($type): void
    {
        if (is_numeric($type) && in_array((int)$type, User::TYPES, true)) {
            $this->where('type', $type);
        }
    }
}
