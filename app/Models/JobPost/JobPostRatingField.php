<?php

namespace App\Models\JobPost;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 * @package App\Models
 *
 * @property int id
 * @property int company_id
 * @property int job_post_id
 * @property string field


 *
 */
class JobPostRatingField extends Model
{

    use SoftDeletes;
    protected $table = 'job_post_rating_fields';
    protected $fillable = [
        'company_id',
        'job_post_id',
        'field',
    ];

    public function company(){
        return $this->belongsTo('App\Models\Company\Company', 'company_id');
    }
    public function jobPost(){
        return $this->belongsTo('App\Models\JobPost\JobPost', 'job_post_id');
    }

}
