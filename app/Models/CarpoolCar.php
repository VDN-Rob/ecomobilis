<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\CarpoolRideReservation;
use Auth;

class CarpoolCar extends Model
{
    protected $table = 'carpool_cars';
    protected $fillable = [  'car_type_id' ,
        'brand',
        'description',
        'default_luggage_id',
        'default_seats_available' ,
        'is_smoking_allowed',
        'is_isofix_present',
        'price_per_km_per_seat'];
    public $timestamps = true;


    /* ------------------ relationships ------------------ */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function type() {
        return $this->belongsTo(CarpoolCarType::class, 'car_type_id');
    }
    public function luggage() {
        return $this->belongsTo(CarpoolLuggage::class, 'default_luggage_id');
    }

}
