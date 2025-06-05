<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CarpoolLuggage extends Model
{
    protected $table = 'carpool_luggages';
    protected $fillable = ['name' ];
    public $timestamps = false;

}
