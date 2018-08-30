<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Question extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'job_post_id',
        'question',
        'answer_1',
        'value_1',
        'answer_2',
        'value_2',
        'answer_3',
        'value_3',
        'answer_4',
        'value_4',
    ];
    public function jobPost()
    {
        return $this->belongsTo('App\Models\JobPost','job_post_id');
    }
    public function answers()
    {
        return $this->hasMany('App\Models\Answers');
    }
}
