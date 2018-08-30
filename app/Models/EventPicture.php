<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EventPicture extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'event_id',
        'path',
    ];
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}
