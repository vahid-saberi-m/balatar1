<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use App\Tools\ApiTrait;
use Illuminate\Http\Request;
use App\Http\Requests;
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

        $this->middleware('auth:api')->only(['store', 'update']);
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
    public function store(Request $request)
    {
        $this->authorize('create', [Company::class]);
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
        $this->authorizeApi('view', $company);

        return $this->companyRepository->show($company);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return int
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
//        $company = $request->isMethod('PUT') ? Company::FindOrFail($id) : new Company();
////        $company->name= $request->input('company_name');
////        $company->company_size = $request->input('company_size');
//
//        if ($company->save()){
//            return new CompanyResource($company);
//        }

//        $this->authorize('view', Company::class, $id);
        return $id;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
