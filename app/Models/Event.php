<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Event extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'title',
        'content',
        'main_photo',
        'tags',
    ];
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
    public function eventPictures()
    {
        return $this->hasMany('App\Models\EventPicture');
    }
}
