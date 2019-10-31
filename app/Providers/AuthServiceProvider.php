<?php

namespace App\Providers;

use App\Models\Company\Company;
use App\Policies\CompanyPolicy;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Company\Company' => 'App\Policies\CompanyPolicy',
        'App\Models\JobPost\JobPost' => 'App\Policies\JobPostPolicy',
        'App\Models\User\User' => 'App\Policies\UserPolicy',
        'App\Models\JobPost\Question' => 'App\Policies\QuestionPolicy',
        'App\Models\Package\Package' => 'App\Policies\PackagePolicy',
        'App\Models\Company\Event' => 'App\Policies\EventPolicy',
        'App\Models\Application\CvFolder' => 'App\Policies\CvFolderPolicy',
        'App\Models\Candidate\Candidate' => 'App\Policies\CandidatePolicy',
        'App\Models\Application\Application' => 'App\Policies\ApplicationPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
