<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 8/28/2018
 * Time: 2:03 PM
 */

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;




class CompanyRepository
{
    public function show(Company $company)
    {
//        $company->load(['jobPosts' => function ($query) {
//            $query->where('is_active', 1)->orderByDesc('id')->take(10);
//        }]);

        return $company;
    }

    /**
     * @param Company $company
     * @param Request $request
     * @return Company
     */
    public function update(Company $company, Request $request)
    {

        $company->update([
            'name' => $request->name,
            'company_size' => $request->company_size,
            'slogan' => $request->slogan,
            'website' => $request->website,
            'logo' => ($request->file('logo'))? $request->file('logo')->store('companies/logos'):$company->main_photo,
            'message_title' => $request->message_title,
            'message_content' => $request->message_content,
            'main_photo' =>($request->file('main_photo'))? $request->file('main_photo')->store('avatars'):$company->main_photo,
            'about_us' => $request->about_us,
            'why_us' => $request->why_us,
            'recruiting_steps' => $request->recruiting_steps,
            'address' => $request->address,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'location' => $request->location,
        ]);
        return $company;
    }

    public function store(Request $request)
    {
        $logo = $request->file('logo')->store('companies/logos');
        $mainPhoto = $request->file('main_photo')->store('companies/main_photos');
        $company = Company::create([
            'name' => $request->name,
            'company_size' => $request->company_size,
            'slogan' => $request->slogan,
            'website' => $request->website,
            'logo' => $logo,
            'message_title' => $request->message_title,
            'message_content' => $request->message_content,
            'main_photo' => $mainPhoto,
            'about_us' => $request->about_us,
            'why_us' => $request->why_us,
            'recruiting_steps' => $request->recruiting_steps,
            'address' => $request->address,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'location' => $request->location,
            'package_id' => '1'
        ]);
        return response()-> $company;
    }

    public function destroy(Company $company){
        $company->delete();
        return 'success';
    }
}