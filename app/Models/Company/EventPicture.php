<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EventPicture
 * @package App\Models
 *  @property int company_id
*@property int event_id
*@property string path
 */

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
        return $this->belongsTo('App\Models\Event\Event');
    }
}
