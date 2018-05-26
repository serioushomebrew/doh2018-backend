<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait HasCoordinatesTrait
 *
 * @package App\Traits
 * @property float|null latitude
 * @property float|null longitude
 */
trait HasCoordinatesTrait
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @param float $radius
     * @return array
     */
    public static function latitudeRanges(float $latitude, float $longitude, float $radius): array
    {
        $miles_radius = $radius * 1.609344;
        $lat_min = $latitude + ($miles_radius / 69);
        $lat_max = $latitude - ($miles_radius / 69);
        $long_min = $longitude + ($miles_radius / (69 * cos(deg2rad($latitude))));
        $long_max = $longitude - ($miles_radius / (69 * cos(deg2rad($latitude))));

        return [$lat_min, $lat_max, $long_min, $long_max];
    }

    /**
     * @param Builder $builder
     * @param float   $latitude
     * @param float   $longitude
     * @param float   $radius
     * @return Builder
     */
    public function scopeRadius(Builder $builder, float $latitude, float $longitude, float $radius): Builder
    {
        [$lat_min, $lat_max, $long_min, $long_max] = self::latitudeRanges($latitude, $longitude, $radius);

        $distance = "6371 * ACOS(COS(RADIANS({$latitude})) * COS(RADIANS(`latitude`)) * COS(RADIANS({$longitude}) - RADIANS(`longitude`)) + SIN(RADIANS({$latitude})) * SIN(RADIANS(`latitude`)))";

        return $builder->selectRaw($this->getTable() . ".*, {$distance} as `distance`")
            ->whereBetween($this->getTable() . '.latitude', [$lat_max, $lat_min])
            ->whereBetween($this->getTable() . '.longitude', [$long_max, $long_min])
            ->whereRaw("{$distance} <= {$radius}");
    }
}
