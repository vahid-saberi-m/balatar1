<?php

namespace App\Models\JobPost;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 * @package App\Models
 * @property int company_id
 * @property int job_post_id
 * @property string question
 * @property string answer_1
 * @property boolean value_1
 * @property string answer_2
 * @property boolean value_2
 * @property string answer_3
 * @property boolean value_3
 * @property string answer_4
 * @property boolean value_4
 */

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
