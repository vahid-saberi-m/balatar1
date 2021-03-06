<?php

namespace App\Policies;

use App\Models\User\User;
use App\Models\Package\Package;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the package.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $package
     * @return mixed
     */
    public function view(User $user, Package $package)
    {
        //
    }

    /**
     * Determine whether the user can create packages.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the package.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $package
     * @return mixed
     */
    public function update(User $user, Package $package)
    {
        //
    }

    /**
     * Determine whether the user can delete the package.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $package
     * @return mixed
     */
    public function delete(User $user, Package $package)
    {
        //
    }

    /**
     * Determine whether the user can restore the package.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $package
     * @return mixed
     */
    public function restore(User $user, Package $package)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the package.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Package  $package
     * @return mixed
     */
    public function forceDelete(User $user, Package $package)
    {
        //
    }
}
