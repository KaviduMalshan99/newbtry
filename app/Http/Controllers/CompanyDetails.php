<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CompanyDetails extends Controller
{
    public function showLatest()
    {
        // Retrieve the latest company logo using direct SQL
        $company_logo = DB::selectOne('SELECT company_logo FROM companies ORDER BY id DESC LIMIT 1');

        // Check if the logo exists
        if (!$company_logo || !$company_logo->company_logo) {
            Session::flash('error', 'No company logo found.');
            return redirect()->route('company.details');
        }

        // Handle the company logo
        $logoPath = asset('storage/' . $company_logo->company_logo);

        // Pass the logoPath to the view
        return view('company_details', ['logoPath' => $logoPath]);
    }
}
