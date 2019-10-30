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
        'App\Models\Company' => 'App\Policies\CompanyPolicy',
        'App\Models\JobPost' => 'App\Policies\JobPostPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Question' => 'App\Policies\QuestionPolicy',
        'App\Models\Package' => 'App\Policies\PackagePolicy',
        'App\Models\Event' => 'App\Policies\EventPolicy',
        'App\Models\CvFolder' => 'App\Policies\CvFolderPolicy',
        'App\Models\Candidate' => 'App\Policies\CandidatePolicy',
        'App\Models\Application' => 'App\Policies\ApplicationPolicy',
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
