<?php

namespace App\Policies;

use App\User;
use App\JobPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the job post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobPost  $jobPost
     * @return mixed
     */
    public function view(User $user, JobPost $jobPost)
    {
        return true;
    }

    /**
     * Determine whether the user can create job posts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the job post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\JobPost  $jobPost
     * @return mixed
     */
    public function update(User $user, JobPost $jobPost)
    {
        //
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
        //
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
