<?php

namespace App\Policies;

use App\Models\Application\Application;
use App\Models\Application\CvFolder;
use App\Models\JobPost\JobPost;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the application.
     *
     * @param  App\Models\User\User $user
     * @param  \App\Models\Application $application
     * @return mixed
     */
    public function show(User $user, Application $application)
    {

        return ($user->company->id == $application->jobPost->company_id) &&
            ($user->jobPosts()->find($application->job_post_id) || $user->hasRole('admin'));
    }

    public function changeCvFolder(User $user, Application $application)
    {

        return ($user->company->id == $application->jobPost->company_id) &&
            ($user->jobPosts()->find($application->job_post_id) || $user->hasRole('admin'));
    }



    /**
     * Determine whether the user can create applications.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the application.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Application $application
     * @return mixed
     */
    public function update(User $user, Application $application)
    {
        //
    }

    /**
     * Determine whether the user can delete the application.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Application $application
     * @return mixed
     */
    public function delete(User $user, Application $application)
    {
        //
    }

    /**
     * Determine whether the user can restore the application.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Application $application
     * @return mixed
     */
    public function restore(User $user, Application $application)
    {

    }

    /**
     * Determine whether the user can permanently delete the application.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Application $application
     * @return mixed
     */
    public function forceDelete(User $user, Application $application)
    {
        //
    }
}
