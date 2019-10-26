<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 9/7/2018
 * Time: 6:42 AM
 */

namespace App\Repositories;

use App\Models\Company;
use App\Models\CvFolder;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;


class CvFolderRepository
{
    public function CreateJobPostCvFolders(JobPost $jobPost)
    {
        $cvFolderNames = ['مردود', 'صف انتظار', 'قابل تامل', 'دعوت به مصاحبه'];
        foreach ($cvFolderNames as $cvFolderName) {
            if ($cvFolderName!= 'مردود') {

                CvFolder::create([
                    'name' => $cvFolderName,
                    'user_id' => $jobPost->user_id,
                    'job_post_id' => $jobPost->id,
                    'company_id' => $jobPost->company_id
                ]);
            }
            if ($cvFolderName === 'مردود') {

                CvFolder::create([
                    'name' => $cvFolderName,
                    'user_id' => $jobPost->user_id,
                    'job_post_id' => $jobPost->id,
                    'company_id' => $jobPost->company_id,
                    'email_template'=> ' عزیز. ضمن تشکر از ابراز تمایل شما برای همکاری با شرکت{{company}} در سمت شغلی {{job-title}} به اطلاع می رساند متاسفانه در حال حاضر امکان همکاری با شما دوست عزیز برای ما فراهم نمی باشد. با آرزوی بهترین ها  {{name}}'                ]);
            }
        }
        return response()->json($jobPost);
    }

    public function store(Request $request, JobPost $jobPost)
    {
        $cvFolder = CvFolder::query()->create([
            'name' => $request->name,
            'user_id' => $jobPost->user_id,
            'job_post_id' => $jobPost->id,
            'company_id' => $jobPost->company_id
        ]);
        return $cvFolder->name;
    }

    public function updateEmailTemplate(Request $request, CvFolder $cvFolder)
    {
        $cvFolder->update(['email_template' => $request->email_template]);
        return $cvFolder->email_template;
    }


}
