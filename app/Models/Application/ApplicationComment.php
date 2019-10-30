<?php

namespace App\Models\Application;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class ApplicationComment

 * @property 'user_id'
 * @property 'application_id'
 * @property 'content'
 */
class ApplicationComment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'application_id',
        'user_id',
        'content',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }
    public function application()
    {
        return $this->belongsTo('App\Models\Candidate\Candidate', 'application_id');
    }
}
