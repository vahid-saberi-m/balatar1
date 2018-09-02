<?php

namespace App\Policies;

use App\Models\JobPost;
use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the company.
     *
     * @param User $user
     * @param Company $company
     * @return mixed
     */
    public function view(User $user, Company $company)
    {
//        if ($company)

        return true /*$user == null || $user->id == $company->user_id*/;
    }

    /**
     * Determine whether the user can create companies.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the company.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Company $company
     * @param JobPost $jobPost
     * @return mixed
     */
    public function update(User $user, Company $company, JobPost $jobPost)
    {
        return $user->company_id == $company->id && ($user->role == 'admin' || $jobPost->user_id== $user->id );
    }

    /**
     * Determine whether the user can delete the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return mixed
     */
    public function delete(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can restore the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return mixed
     */
    public function restore(User $user, Company $company)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the company.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Company  $company
     * @return mixed
     */
    public function forceDelete(User $user, Company $company)
    {
        //
    }
}
