<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Class Event
 * @package App\Models
 * @property int id
 * @property int company_id
 * @property string title
 * @property string content
 * @property string main_photo
 * @property string tags
 * @property Company company
 * @property Collection eventPictures
 */

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
