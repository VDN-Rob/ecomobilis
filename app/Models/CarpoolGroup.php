<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class CarpoolGroup extends Model
{
    public $table = 'carpool_groups';
    protected $fillable = [
        'title',
        'location_street_coordinates_id',
        'does_need_authentication',
        'token',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rides()
    {
        $travelStartDatetime = Carbon::now()->subHours(1);

        return $this->hasMany(CarpoolRide::class, 'group_id')
            ->where('travel_start_datetime', '>', $travelStartDatetime)
            ->orderBy('travel_start_datetime', 'asc');
    }

    public function location()
    {
        return $this->belongsTo(CarpoolStreetCoordinate::class, 'location_street_coordinates_id');
    }

}
