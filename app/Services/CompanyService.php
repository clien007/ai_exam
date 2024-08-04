<?php

namespace App\Services;

use App\Models\Company;
use App\Validators\CompanyValidator;
use Illuminate\Http\Request;

class CompanyService
{
    private $validator;

    public function __construct(CompanyValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getAllCompanies()
    {
        return Company::orderBy('id', 'desc')->get();
    }

    public function storeCompany(Request $request)
    {
        $this->validator->validate($request);
        Company::create($request->all());
    }

    public function updateCompany(Request $request, Company $company)
    {
        $this->validator->validate($request);
        $company->update($request->all());
    }
}
