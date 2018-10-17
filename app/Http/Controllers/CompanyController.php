<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Resources\Users\CompanyUsersResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Tools\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Resources\Company as CompanyResource ;
use App\Models\Company;



/**
 * @property CompanyRepository company
 * @property CompanyRepository companies
 */
class CompanyController extends Controller
{
    use ApiTrait;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;

        $this->middleware('auth:api')->only(['store', 'update','destroy']);
    }

    public function companyUsers(Company $company){
        $this->authorizeApi('update',$company);
        return CompanyUsersResource::collection($company->users);
    }

    /**
     * Display a listing of the resource.
     *\
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //get companies
        $companies= Company::paginate(15);

        //Return collection of companies to resource
        return CompanyResource::collection($companies);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CompanyRequest $request)
    {
        $this->authorizeApi('store',Company::class);
        return $this->companyRepository->store($request);

    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Company
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Company $company)
    {
        return $this->companyRepository->show($company);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Company $company
     * @param  \Illuminate\Http\Request $request
     * @return Company
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Company $company, CompanyRequest $request )
    {
        $this->authorizeApi('update', $company );
        return $this->companyRepository->update($company,$request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Company $company)
    {
//        dd(auth()->user()->name);
        $this->authorizeApi('destroy', $company );
       return $this->companyRepository->destroy($company);

    }
}
