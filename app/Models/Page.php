<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Page extends Model
{

    protected $fillable = ['title',
        'slug',
        'cover_image',
        'is_live',
        'is_show_in_top_nav',
        'is_show_in_footer_nav',
        'intro',
        'body'];
    public $timestamps = true;
    protected $table = 'pages';

    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }




}
