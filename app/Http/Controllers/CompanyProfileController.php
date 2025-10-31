<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function show()
    {
        $company = Auth::guard('company')->user();
        return view('company.profile', compact('company'));
    }

    public function update(Request $request)
    {
        $company = Auth::guard('company')->user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:companies,email,' . $company->id,
            'cell_no' => 'required|string|max:20',
            'accounts_mobile' => 'nullable|string|max:20',
            'accounts_email' => 'nullable|string|max:255',
            'cnic_no' => 'nullable|string|max:20',
            'ntn_no' => 'nullable|string|max:20',
            'account_activity' => 'nullable|string|max:255',
            'company_address' => 'required|string',
            'website' => 'nullable|url|max:255',
            'gst_no' => 'nullable|string|max:50',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cnic_front' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cnic_back' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ntn_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'company_logo.image' => 'Company logo must be an image file.',
            'company_logo.mimes' => 'Company logo must be a JPEG, PNG, JPG, GIF, or SVG file.',
            'company_logo.max' => 'Company logo must not be larger than 2MB.',
            'cnic_front.image' => 'CNIC front must be an image file.',
            'cnic_front.mimes' => 'CNIC front must be a JPEG or PNG file.',
            'cnic_front.max' => 'CNIC front must not be larger than 2MB.',
            'cnic_back.image' => 'CNIC back must be an image file.',
            'cnic_back.mimes' => 'CNIC back must be a JPEG or PNG file.',
            'cnic_back.max' => 'CNIC back must not be larger than 2MB.',
            'ntn_image.image' => 'NTN image must be an image file.',
            'ntn_image.mimes' => 'NTN image must be a JPEG or PNG file.',
            'ntn_image.max' => 'NTN image must not be larger than 2MB.',
        ]);

        try {
            // Update basic company information
            $updateData = [
                'name' => $request->company_name,
                'email' => $request->email,
                'phone' => $request->cell_no,
                'address' => $request->company_address,
                'contact_first_name' => $request->first_name,
                'contact_last_name' => $request->last_name,
            ];

            // Add optional fields only if they have values
            if ($request->filled('cnic_no')) {
                $updateData['cnic_no'] = $request->cnic_no;
            }
            if ($request->filled('ntn_no')) {
                $updateData['ntn_no'] = $request->ntn_no;
            }
            if ($request->filled('account_activity')) {
                $updateData['account_activity'] = $request->account_activity;
            }
            if ($request->filled('accounts_email')) {
                $updateData['accounts_email'] = $request->accounts_email;
            }
            if ($request->filled('accounts_mobile')) {
                $updateData['accounts_mobile'] = $request->accounts_mobile;
            }
            if ($request->filled('website')) {
                $updateData['website'] = $request->website;
            }
            if ($request->filled('gst_no')) {
                $updateData['gst_no'] = $request->gst_no;
            }

            // Handle file uploads FIRST - Delete old files first
            if ($request->hasFile('company_logo')) {
                // Delete old logo if exists
                if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                    Storage::disk('public')->delete($company->logo);
                }
                $logoPath = $request->file('company_logo')->store('company/logos', 'public');
                if ($logoPath) {
                    $updateData['logo'] = $logoPath;
                }
            }

            if ($request->hasFile('cnic_front')) {
                // Delete old CNIC front if exists
                if ($company->cnic_front && Storage::disk('public')->exists($company->cnic_front)) {
                    Storage::disk('public')->delete($company->cnic_front);
                }
                $cnicFrontPath = $request->file('cnic_front')->store('company/documents', 'public');
                if ($cnicFrontPath) {
                    $updateData['cnic_front'] = $cnicFrontPath;
                }
            }

            if ($request->hasFile('cnic_back')) {
                // Delete old CNIC back if exists
                if ($company->cnic_back && Storage::disk('public')->exists($company->cnic_back)) {
                    Storage::disk('public')->delete($company->cnic_back);
                }
                $cnicBackPath = $request->file('cnic_back')->store('company/documents', 'public');
                if ($cnicBackPath) {
                    $updateData['cnic_back'] = $cnicBackPath;
                }
            }

            if ($request->hasFile('ntn_image')) {
                // Delete old NTN image if exists
                if ($company->ntn_image && Storage::disk('public')->exists($company->ntn_image)) {
                    Storage::disk('public')->delete($company->ntn_image);
                }
                $ntnImagePath = $request->file('ntn_image')->store('company/documents', 'public');
                if ($ntnImagePath) {
                    $updateData['ntn_image'] = $ntnImagePath;
                }
            }

            // Update all data including file paths in one go
            $company->update($updateData);

            // Refresh the company model to get updated data
            $company->refresh();

            return redirect()->back()->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Company profile update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to update profile: ' . $e->getMessage())
                ->withInput();
        }
    }
}
