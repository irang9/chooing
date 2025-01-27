<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyInfo;

class CompanyInfoController extends Controller
{
    /**
     * Validation rules are separated for reuse and better readability.
     *
     * @return array
     */
    private function validationRules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'company_biz_reg_number' => 'nullable|string|max:255',
            'company_ceo_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'complaint_email' => 'nullable|email|max:255',
            'publishing_brand' => 'nullable|string|max:255',
            'publishing_phone' => 'nullable|string|max:255',
            'publishing_email' => 'nullable|email|max:255',
            'office_building' => 'nullable|string|max:255',
            'office_management' => 'nullable|string|max:255',
            'office_fire_safety' => 'nullable|string|max:255',
            'office_communication' => 'nullable|string|max:255',
        ];
    }

    /**
     * Show the company information management page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the first company information record or null if not exists
        $companyInfo = CompanyInfo::first();
        return view('admin.company_info', compact('companyInfo'));
    }

    /**
     * Store or update company information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate($this->validationRules());

        // 빈 값인 경우 기본값 할당
        $validatedData = array_map(function($value) {
            return $value === null ? '' : $value;
        }, $validatedData);

        // Update or create the company information record
        CompanyInfo::updateOrCreate(
            ['id' => 1], // Find record with ID 1
            $validatedData // Update with validated data
        );

        // Redirect back with a success message
        return redirect()->route('admin.company_info.index')->with('success', '저장되었습니다.');
    }
}