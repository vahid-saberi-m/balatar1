<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'name'=>'رایگان',
            'daily_cv_view'=>15,
            'monthly_cv_view'=>100,
            'per_job_post_cv_view'=>30,
            'active_job_post_limit'=>3,
            'question_per_job_post_limit'=>1,
            'package_lifetime'=>null,
            'job_post_lifetime_limit'=>14
        ]);
        DB::table('packages')->insert([
            'name'=>'برنز',
            'daily_cv_view'=>50,
            'monthly_cv_view'=>600,
            'per_job_post_cv_view'=>100,
            'active_job_post_limit'=>7,
            'question_per_job_post_limit'=>2,
            'package_lifetime'=>365,
            'job_post_lifetime_limit'=>30
        ]);
        DB::table('packages')->insert([
            'name'=>'طلایی',
            'daily_cv_view'=>null,
            'monthly_cv_view'=>null,
            'per_job_post_cv_view'=>null,
            'active_job_post_limit'=>null,
            'question_per_job_post_limit'=>null,
            'package_lifetime'=>null,
            'job_post_lifetime_limit'=>null
        ]);
    }
}
