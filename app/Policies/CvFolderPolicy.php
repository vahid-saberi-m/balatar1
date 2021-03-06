<?php

namespace App\Policies;

use App\Models\User\User;
use App\Models\Application\CvFolder;
use Illuminate\Auth\Access\HandlesAuthorization;

class CvFolderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the cv folder.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Application\\CvFolder  $cvFolder
     * @return mixed
     */
    public function view(User $user, CvFolder $cvFolder)
    {
        //
    }

    /**
     * Determine whether the user can create cv folders.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the cv folder.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Application\\CvFolder  $cvFolder
     * @return mixed
     */
    public function update(User $user, CvFolder $cvFolder)
    {
        //
    }

    /**
     * Determine whether the user can delete the cv folder.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CvFolder  $cvFolder
     * @return mixed
     */
    public function delete(User $user, CvFolder $cvFolder)
    {
        //
    }

    /**
     * Determine whether the user can restore the cv folder.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Application\CvFolder  $cvFolder
     * @return mixed
     */
    public function restore(User $user, CvFolder $cvFolder)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the cv folder.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CvFolder  $cvFolder
     * @return mixed
     */
    public function forceDelete(User $user, CvFolder $cvFolder)
    {
        //
    }
}
