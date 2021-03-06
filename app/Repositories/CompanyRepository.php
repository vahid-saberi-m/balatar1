<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 8/28/2018
 * Time: 2:03 PM
 */

namespace App\Repositories;

use App\Http\Resources\Company\PublicCompanyPageResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\Users\CompanyUsersResource;
use App\Mail\AppliedForJobPostAppliedForJobPost;
use App\Models\Company\Company;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;

class CompanyRepository
{
    public function show(Company $company)
    {
//        Mail::to('saberi1365@gmail.com')->send(new AppliedForJobPost());
            return new PublicCompanyPageResource($company);

    }

    public function userApproval(User $user){
        $user->update(['is_approved'=>!$user->is_approved]);
        return CompanyUsersResource::collection($user->company->users);
    }
   public function disOwnUser(User $user){
        $user->update(['company_id'=>null]);
        return CompanyUsersResource::collection($user->company->users);
    }
    /**
     * @param Company $company
     * @param Request $request
     * @return Company
     */
    public function update(Company $company, Request $request)
    {
        if ($request->file('logo')) {
            $logo = $request->file('logo')->store('companies/logos');
        } else {
            $logo = $company->logo;
        }
        if ($request->file('main_photo')) {
            $mainPhoto = $request->file('main_photo')->store('companies/main_photos');
        } else {
            $mainPhoto = $company->main_photo;
        }
        $company->update(array_merge(
            $request->all(),
            [
                'logo' => $logo,
                'main_photo' => $mainPhoto
            ]
        ));
        return new CompanyResource($company);
    }

    public function store(Request $request)
    {
        $logo = $request->file('logo')->store('companies/logos');
        $mainPhoto = $request->file('main_photo')->store('companies/main_photos');
//        dd($request->name);
        $company = Company::create(array_merge(
            $request->all(),
            [
                'logo' => $logo,
                'main_photo' => $mainPhoto,
                'package_id'=>1
            ]
        ));
        auth()->user()->assignRole('admin');
        return new CompanyResource($company);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return 'deleted';
    }
}
