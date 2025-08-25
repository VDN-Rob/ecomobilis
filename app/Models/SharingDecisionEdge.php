<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharingDecisionEdge extends Model
{
    protected $fillable = ['node_id', 'answer', 'child_id'];

    public function child()
    {
        return $this->belongsTo(SharingDecisionNode::class, 'child_id');
    }
}
