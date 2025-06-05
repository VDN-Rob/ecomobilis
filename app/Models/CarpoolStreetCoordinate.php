<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CarpoolStreetCoordinate extends Model
{
    protected $table = 'carpool_street_coordinates';
    protected $fillable = ['street','zip_code', 'city', 'country', 'external_api_id', 'external_api_source', 'osm_id', 'osm_way', 'lat','lng' ];
    public $timestamps = true;

    // returns the object of the street, already in db or added
    public function getStreet($json)  {

        $arr = json_decode($json);
        Log::debug('getStreetId');
        Log::debug($json);

        $extId = false;
        if(isset($arr->place_id)) {
            $extId = $arr->place_id;
        }
        if(isset($arr->external_api_id)) {
            $extId = $arr->external_api_id ;
        }
        $entryFound = $this::where('external_api_id', $extId)->first();

        if(!$entryFound){}
        if ($entryFound) {
            // return the entry
            return $entryFound;
        } else {
            // city is not always there
            $city = 'unknown';
            if(isset($arr->address->city)) {
                $city = $arr->address->city;
            } elseif(isset($arr->address->state))  {
                $city = $arr->address->state;
            }
            if(isset($arr->address->road)) {
                $name = $arr->address->road;
            } elseif(isset($arr->address->state))  {
                $name = $arr->address->name;
            }
            $postcode = '';
            if(isset($arr->address->postcode)) {
                $postcode = $arr->address->postcode;
            }

            $data = [
                'street'                => $name,
                'zip_code'              => $postcode,
                'city'                  => $city,
                'country'               => $arr->address->country,
                'external_api_id'       => $arr->place_id,
                'external_api_source'   => 'locationiq',
                'osm_id'                => $arr->osm_id,
                'osm_way'               => $arr->osm_type,
                'lat'                   => $arr->lat,
                'lng'                   => $arr->lon,
            ];

            return $this->create($data);
        }


    }

}
