<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function application()
    {
        return $this->belongsTo('App\Models\Candidate', 'application_id');
    }
}
