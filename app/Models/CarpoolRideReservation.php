<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Auth;

class CarpoolRideReservation extends Model
{
    protected $table = 'carpool_rides_reservations';
    protected $fillable = [ 'ride_id', 'passenger_user_id', 'amount',  'is_accepted', 'is_rejected'];
    public $timestamps = true;

    /* ------------------ relationships ------------------ */
    public function ride()
    {
        return $this->belongsTo(CarpoolRide::class, 'ride_id');
    }

    public function passenger() {
        return $this->belongsTo(User::class, 'passenger_user_id');
    }


    /* ------------------ custom ------------------ */




}
