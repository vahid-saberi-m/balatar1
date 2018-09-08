<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Models\JobPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPostPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->role=='super admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the job post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobPost  $jobPost
     * @return mixed
     */
    public function indexUser($company)
    {
        $user=auth()->user();
        return $user->company_id == $company->id;
    }

    /**
     * Determine whether the user can create job posts.
     *
     * @param Request $request
     * @return mixed
     */
//    public function store(User $user,Request $request)
//    {
//        $date=new Carbon($request->publish_date);
//        $expirationDate=new Carbon($request->expiration_date);
////        dd($date);
////        $user=auth()->user();
//        return ($user->company_id == $request->company_id)
//            &&($expirationDate->isAfter($date))
//            &&($date->isAfter(now()))
//            ;
//    }

    public function approval($jobPost){
        return (auth()->user()->company_id==$jobPost->company_id)&&(auth()->user()->role=='admin');
    }

    /**
     * Determine whether the user can update the job post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobPost  $jobPost
     * @return mixed
     */
    public function activate(User $user,JobPost $jobPost){
        return ($user->role== 'admin')&&($user->company_id== $jobPost->company_id);
    }
    public function update(User $user,JobPost $jobPost)
    {
        return ($jobPost->user_id==$user->id)||(($user->company_id==$jobPost->company_id)&&($user->role=='admin'));
    }

    /**
     * Determine whether the user can delete the job post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobPost  $jobPost
     * @return mixed
     */
    public function delete(User $user, JobPost $jobPost)
    {
        return ($jobPost->user_id==$user->id)||(($user->company_id==$jobPost->company_id)&&($user->role=='admin'));
    }

    /**
     * Determine whether the user can restore the job post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobPost  $jobPost
     * @return mixed
     */
    public function restore(User $user, JobPost $jobPost)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the job post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobPost  $jobPost
     * @return mixed
     */
    public function forceDelete(User $user, JobPost $jobPost)
    {
        //
    }
}
