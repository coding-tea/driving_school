<?php

namespace App\Traits\GeoJson;

use App\Models\GeoJson\FeatureCollection;

trait Geo
{
    /**
     * Get the post's image.
     */
    public function featureCollections()
    {
        return $this->morphMany(FeatureCollection::class, 'locationable');
    }
    public function groupedLocations()
    {
        $locations = collect([]);
        $features = [];

        foreach ($this->featureCollections as $collection) {
            foreach ($collection->features as $feature) {
//                $locations['type'] = $feature['type'];
                $features[] = $feature;
            }
        }
        foreach ($features as $feature) {
            if ($feature->locations->count()) {
                $locations->add(
                    $feature->locations
                );
            }
        }


        return $this->featureCollections;
    }


}
