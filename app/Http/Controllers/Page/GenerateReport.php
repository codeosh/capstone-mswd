<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;

class GenerateReport extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::all();
        return view('page.generate_report', compact('beneficiaries'));
    }
}
