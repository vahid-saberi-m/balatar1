<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 9/25/2018
 * Time: 11:02 AM
 */

namespace App\Repositories;


use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Company\Company;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserRepository
{

    public function joinCompany(Company $company, Request $request){
        $validator=Validator::make($request->all(),[
            'position'=>'required|max:40',
            'image'=>'nullable|image|max:1000'
        ]);
        if ($validator->fails()) {
            return redirect('post/create')
                ->withErrors($validator)
                ->withInput();
        }
        auth()->user()->update(['company_id' => $company->id,
            'is_approved' => 0,
            'position'=>$request->position,
            'image'=>$request->file('image')->store('users')
        ]);
        return \auth()->user();
    }
    public function update(User $user, Request $request)
    {
        if($request->file('image')){
            $image=$request->file('image')->store('users/');
        }else{
            $image=$user->image;
        }
        $user->update(array_merge($request->all(),['image'=>$image]));
        return new UserResource($user);
    }
}