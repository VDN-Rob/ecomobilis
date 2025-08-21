<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Auth;

class PageBlock extends Model
{

    protected $fillable = ['title',
        'page_id',
          'title',
          'image_url',
          'body', 'sort_order',
          'layout',
    ];
    public $timestamps = true;
    protected $table = 'pages_blocks';



}
