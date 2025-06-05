<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ApiKey extends Model
{
    protected $table = 'api_keys';

    protected $fillable = ['key', 'name'];

}
