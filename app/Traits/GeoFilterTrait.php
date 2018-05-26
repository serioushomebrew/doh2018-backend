<?php

namespace App\Traits;

trait GeoFilterTrait
{
    /**
     * @param mixed $geo
     * @return void
     */
    public function geo($geo): void
    {
        if (is_array($geo) && isset($geo['latitude'], $geo['longitude'], $geo['radius'])) {
            $this->radius($geo['latitude'], $geo['longitude'], $geo['radius']);
        }
    }
}
