<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarpoolStreetCoordinate extends Model
{
    protected $table = 'carpool_street_coordinates';
    protected $fillable = ['street','zip_code', 'city', 'country', 'external_api_id', 'external_api_source', 'osm_id', 'osm_way', 'lat','lng', 'user_id', 'manually_validated'  ];
    public $timestamps = true;

    // returns the object of the street, already in db or added
    public function getStreet($json)  {

        $arr = json_decode($json);
        Log::debug('-------- CarpoolStreetCoordinate > getStreetId ---------');
        Log::debug($json);

        $extId = false;

        // LOCATION IQ LOCATION
        if(isset($arr->place_id)) {
            $extId = $arr->place_id;
        }
        if(isset($arr->external_api_id)) {
            $extId = $arr->external_api_id ;
        }
        if($extId) {
            $entryFound = $this::where('external_api_id', $extId)->first();
        }

        // MANUALLY ADDED LOCATION
        if(isset($arr->id)) {
            $entryFound = $this::find($arr->id);
        }

        if ($entryFound) {
            // return the entry
            Log::debug('Address exists already -- carpool_street_coordinates ID '. $entryFound->id);
            return $entryFound;
        } else {
            // Docu: city is not always there
            Log::debug('Address does not exist. To be created...');
            $city = 'unknown';
            $name = 'unknown';

            if(!empty($arr->place_id)) {
                if(isset($arr->display_name_short)) {
                    $name = $arr->display_name_short;
                } else {
                    if(isset($arr->address->road)) {
                        $name = $arr->address->road;
                    } elseif(isset($arr->address->city))  {
                        $name = $arr->address->city;
                    } elseif(isset($arr->address->state))  {
                        $name = $arr->address->name;
                    }
                }
                if(isset($arr->address->city)) {
                    $city = $arr->address->city;
                } elseif(isset($arr->address->state))  {
                    $city = $arr->address->state;
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
            } else {
                Log::debug('Address is empty');
                return false;
            }



        }

    }


    // content can be from location iq or locally
    public function createCustomDisplayNames($content)  {

        foreach($content as $key =>  $entry) {

            $name = '';
            $city = '';

            if(is_array($entry)) {
                // locally already
                $validatedCheck = '';
                if($entry['manually_validated'] == 1) {
                    $validatedCheck = '✓';
                }
                if(!empty($entry['zip_code'])) {
                    $content[$key]['display_name_short'] = $entry['street'].', ' . $entry['city'] . ' ('.$entry['zip_code'].') '. $validatedCheck;
                } else {
                    $content[$key]['display_name_short'] = $entry['street'].', ' . $entry['city'] . ' '. $validatedCheck;
                }
            } else {
                if(isset($entry->address->name)) {
                    $name = $entry->address->name.', ';
                } elseif(isset($entry->address->state) && !isset($entry->address->city))  {
                    $name = $entry->address->state.', ';
                }
                if(isset($entry->address->city)) {
                    $city = $entry->address->city;
                } elseif(isset($entry->address->state))  {
                    $city = $entry->address->state;
                }
                $postcode = '';
                if(isset($entry->address->postcode)) {
                    $postcode = ' ('.$entry->address->postcode.')';
                }
                $entry->display_name_short = $name . $city . $postcode ;
            }

        }

        return $content;
    }

    // searches locally for manyally added names
    public function findDisplayNames($searchString)  {

        $locations = [];
        if (strlen($searchString) > 2) {
            $locations = $this->where(function ($query) use ($searchString)  {
                            $query->where('street', 'like', '%' . $searchString . '%')
                                ->orWhere('zip_code', 'like', '%' . $searchString . '%')
                                ->orWhere('city', 'like', '%' . $searchString . '%')
                                ->orWhere(DB::raw('CONCAT(street," ",city)'), 'LIKE', '%'.$searchString.'%');
                        })->orderBy('id', 'asc')->limit(200)->get()->toArray();
        }


        return $locations;
    }


}
