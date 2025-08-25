<?php

namespace App\Models;

use App\Models\SharingDecisionNode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Auth;

class SharingOrg extends Model
{
    protected $table = 'sharing_organisations';
    protected $fillable = ['name',  'short_description', 'body',
      'prop_vehicle_car',
      'prop_vehicle_ecar',
      'prop_vehicle_bike',
      'prop_vehicle_ebike',
      'prop_vehicle_cargobike',
      'prop_vehicle_ecargobike',
      'prop_vehicle_step',

      'website',
      'email',

      'payment_subscription_info', 'user_id',
    ];

    public $timestamps = true;

    public function decisionNodes()
    {
        return $this->belongsToMany(SharingDecisionNode::class, 'sharing_decision_node_organisation');
    }

}
