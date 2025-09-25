<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\CarpoolRideReservation;
use Auth;

class CarpoolRide extends Model
{
    protected $table = 'carpool_rides';
    protected $fillable = ['travel_start_datetime','from_street_coordinates_id', 'to_street_coordinates_id',
        'luggage_id',  'seats_available',  'remark',  'price_per_seat',  'user_id', 'group_id', 'is_private', 'is_cancelled'];
    public $timestamps = true;
    protected $dates = ['travel_start_datetime'];

    /* ------------------ relationships ------------------ */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function departure()
    {
        return $this->belongsTo(CarpoolStreetCoordinate::class, 'from_street_coordinates_id');
    }
    public function arrival()
    {
        return $this->belongsTo(CarpoolStreetCoordinate::class, 'to_street_coordinates_id');
    }
    public function messages()
    {
        return $this->hasMany(CarpoolMessage::class, 'car_ride_id');
    }
    public function luggage()
    {
        return $this->belongsTo(CarpoolLuggage::class, 'luggage_id');
    }
    public function group()
    {
        return $this->belongsTo(CarpoolGroup::class, 'group_id');
    }
    public function reservations()
    {
        return $this->hasMany(CarpoolRideReservation::class, 'ride_id');
    }

    public function reservationUsers()
    {
         return $this->belongsToMany(User::class, 'carpool_rides_reservations', 'ride_id', 'passenger_user_id');
    }

    public function reservedamount()
    {
        return $this->belongsToMany(User::class, 'carpool_rides_reservations', 'ride_id', 'passenger_user_id')->where('is_accepted', 1);
    }


    /* ------------------ custom ------------------ */

    // uses in side nav
    public function messagesGrouped()
    {
        $messages = $this->hasMany(CarpoolMessage::class, 'car_ride_id')->groupBy('conversation_partner_user_id', 'user_id');

        return $messages;
    }


    /* docu https://medium.com/@techsolutionstuff/laravel-11-find-nearest-location-by-latitude-and-longitude-c6ac5c6918dc
    */
    public function getMatchingRides($streetDepObj, $streetArrObj, $travelStartDatetime)
    {
        $maxDistance         = 20;
        $travelStartDatetime = Carbon::parse($travelStartDatetime)->subHours(1);

        // all rides in future
        $depIds = $this->where('is_private', 0)->where('travel_start_datetime', '>', $travelStartDatetime)->get()->pluck('from_street_coordinates_id');

        // A. close by departures coordinates
        $latDep = $streetDepObj->lat;
        $lonDep = $streetDepObj->lon;

        $coordinatesCloseByDep = CarpoolStreetCoordinate::select("carpool_street_coordinates.id"
            ,DB::raw("6371 * acos(cos(radians(" . $latDep . "))
                    * cos(radians(carpool_street_coordinates.lat))
                    * cos(radians(carpool_street_coordinates.lon) - radians(" . $lonDep . "))
                    + sin(radians(" .$latDep. "))
                    * sin(radians(carpool_street_coordinates.lat))) AS distance"))
            ->whereIn('carpool_street_coordinates.id', $depIds)
            ->orderBy('distance', 'asc')
            ->get();

        // clean it up, and filter within max distance
        $cleanCoordinatesCloseByDepIds = [];
        foreach($coordinatesCloseByDep as $co) {
            if($co->distance <= $maxDistance) {
                $cleanCoordinatesCloseByDepIds[] = $co->id;
            }
        }

        // B. check if from those close by departure they go to a closeby arrival point
        $arrIds = $this->where('travel_start_datetime', '>', $travelStartDatetime)->get()->pluck('to_street_coordinates_id');
        $latArr = $streetArrObj->lat;
        $lonArr = $streetArrObj->lon;
        $coordinatesCloseByArr = CarpoolStreetCoordinate::select("carpool_street_coordinates.id"
            ,DB::raw("6371 * acos(cos(radians(" . $latArr . "))
                    * cos(radians(carpool_street_coordinates.lat))
                    * cos(radians(carpool_street_coordinates.lon) - radians(" . $lonArr . "))
                    + sin(radians(" .$latArr. "))
                    * sin(radians(carpool_street_coordinates.lat))) AS distance"))
            ->whereIn('carpool_street_coordinates.id', $arrIds)
            ->orderBy('distance', 'asc')
            ->get();
        $cleanCoordinatesCloseByArrIds = [];
        foreach($coordinatesCloseByArr as $co) {
            if($co->distance <= $maxDistance) {
                $cleanCoordinatesCloseByArrIds[] = $co->id;
            }
        }

        $rides = $this
            ->whereIn('from_street_coordinates_id', $cleanCoordinatesCloseByDepIds)
            ->whereIn('to_street_coordinates_id', $cleanCoordinatesCloseByArrIds)
            ->where('travel_start_datetime', '>', $travelStartDatetime)
            ->orderBy('travel_start_datetime', 'asc')
            ->get();

        return $rides;

    }


}
