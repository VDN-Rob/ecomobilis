<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SharingOrg;

class SharingDecisionNode extends Model
{
    protected $fillable = ['question', 'result',  'result_ids', 'is_leaf'];

    public function edges()
    {
        return $this->hasMany(SharingDecisionEdge::class, 'node_id');
    }
    public function organisations()
    {
        return $this->belongsToMany(SharingOrg::class, 'sharing_decision_node_organisation');
    }
}
