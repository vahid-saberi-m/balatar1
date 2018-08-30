<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\JobPost;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([PackagesTableSeeder::class]);

        $companies=factory(App\Models\Company::class, 20)->create()->each(function ($company) {
            $company->users()->save(factory(App\Models\User::class)->make());
            $company->events()->save(factory(\App\Models\Event::class)->make());
        });
        foreach ($companies as $company)
            $company->packageUsages()->save(factory(\App\Models\PackageUsage::class)->make([
                'company_id'=>$company->id,
                'package_id'=>$company->first()->package_id
            ]));
        factory(App\Models\EventPicture::class,20)->create();

        factory(JobPost::class, 70)->create()->each(function ($jobPost) {
            $jobPost->cvFolders($jobPost)->save(factory(App\Models\CvFolder::class)->states('declined')->make(
                ['company_id' => $jobPost->company_id,
                    'user_id' => $jobPost->user_id
                ]
            ));
            $jobPost->cvFolders($jobPost)->save(factory(App\Models\CvFolder::class)->states('waiting-queue')->make(
                ['company_id' => $jobPost->company_id,
                    'user_id' => $jobPost->user_id
                ]
            ));
            $jobPost->cvFolders($jobPost)->save(factory(App\Models\CvFolder::class)->states('to-be-considered')->make(
                ['company_id' => $jobPost->company_id,
                    'user_id' => $jobPost->user_id
                ]
            ));
            $jobPost->cvFolders($jobPost)->save(factory(App\Models\CvFolder::class)->states('inviting-to-interview')->make(
                ['company_id' => $jobPost->company_id,
                    'user_id' => $jobPost->user_id
                ]
            ));

        });

        factory(\App\Models\Candidate::class, 500)->create()->each(function ($candidate) {
            $candidate->candidateCvs()->save(factory(\App\Models\CandidateCv::class)->make());
            $candidate->applications()->save(factory(\App\Models\Application::class)->make());
        });
        factory(\App\Models\Question::class, 50)->create();


    }
}
