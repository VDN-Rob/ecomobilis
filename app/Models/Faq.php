<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Faq extends Model
{
    protected $table = 'faq';
    protected $fillable = [
        'category',
        'order',
        'question',
        'answer'
    ];
    public $timestamps = true;


}
