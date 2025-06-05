<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\CarpoolRideReservation;
use Auth;

class CarpoolCarType extends Model
{
    protected $table = 'carpool_car_types';
    protected $fillable = ['type'];
    public $timestamps = true;



}
