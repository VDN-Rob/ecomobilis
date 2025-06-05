<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;


class Blog extends Model
{

    protected $fillable = array(
         'title',
         'slug',
         'cover_image',
         'user_id',
         'is_live',
         'intro', 'body',
         'date_posted',
         'topic',
         'reading_time'
    );
    public $timestamps = true;
    protected $table = 'blog';
    // note $casts is the new $dates
    protected $casts = [
        'date_posted' => 'datetime',
    ];

    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_en'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}
