<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function create()
    {
        $company = Company::first();
        return view('admin.company_management.create', compact('company'));
    }

    public function storeOrUpdate(Request $request)
    {

        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $company = Company::first(); // Assuming only one company record

        if (!$company) {
            $company = new Company();
        }

        // Handle file upload for company logo
        if ($request->hasFile('company_logo')) {
            if ($company->company_logo) {
                Storage::disk('public')->delete($company->company_logo);
            }
            $logoPath = $request->file('company_logo')->store('logos', 'public');
            $company->company_logo = $logoPath;
        }

        // Save other details
        $company->company_name = $request->input('company_name');
        $company->address = $request->input('address');
        $company->contact = $request->input('contact');
        $company->email = $request->input('email');
        $company->save();


        return redirect()->route('company.create')->with('success', 'Company details saved successfully.');
    }
}
