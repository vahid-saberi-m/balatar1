<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 8/28/2018
 * Time: 2:03 PM
 */

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    public function show(Company $company)
    {
        $company->load(['jobPosts' => function($query) { $query->where('is_active', 1)->orderByDesc('id')->take(10);}]);

        return $company;
    }
}