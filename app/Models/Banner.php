<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'hero_tag',
        'hero_title_1',
        'hero_title_2',
        'hero_subtitle',
        'slide_1',
        'slide_2',
        'slide_3',
        'slide_4',
        'slide_5',
    ];
}
