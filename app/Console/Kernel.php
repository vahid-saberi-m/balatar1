<?php

namespace App\Console;

use App\Models\Company\Company;
use App\Models\Package\PackageUsage;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\JobPost\JobPost;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call( function (){
            $date = new  Carbon();
        $date = $date->toDateString();
        $publishingJobPosts = JobPost::where('publish_date', $date)->all();
        foreach ($publishingJobPosts as $publishingJobPost) {
            $publishingJobPost->update('is_active', 1);
            app('App\Http\Controllers\CvFolderController')->createJobPostCvFolders($publishingJobPost);
        }
        $date=Carbon::yesterday();
        $expiredJobPosts = JobPost::where('expiration_date', $date)->all();
        foreach ($expiredJobPosts as $expiredJobPost) {
            $expiredJobPost->update('is_active', 0);
        }})->
        daily();

        $schedule->call(function (){
           $packageUsages= PackageUsage::all();
           foreach ($packageUsages as $packageUsage){
             $dailyViews= $packageUsage->package()->daily_cv_view;
             $packageUsage->update(['daily_cv_view_left'=>$dailyViews]);
           }})
            ->daily();

        $schedule->call(function (){
            $packageUsages= PackageUsage::all();
            foreach ($packageUsages as $packageUsage){
                $monthlyViews= $packageUsage->package()->monthly_cv_view;
                $packageUsage->update(['monthly_cv_view_left'=>$monthlyViews]);
            }})
            ->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
