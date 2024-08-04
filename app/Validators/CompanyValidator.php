<?php

namespace App\Validators;

use Illuminate\Http\Request;

class CompanyValidator
{
    public function validate(Request $request)
    {
        $request->validate([
            'logo' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);
    }
}
