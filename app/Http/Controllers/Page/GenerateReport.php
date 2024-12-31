<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class GenerateReport extends Controller
{
    public function index()
    {
        $beneficiaries = Beneficiary::orderBy('created_at', 'desc')->get();
        return view('page.generate_report', compact('beneficiaries'));
    }

    public function filterReport(Request $request)
    {
        $query = Beneficiary::query();
        Log::info('Filter Params:', $request->all());

        if ($request->filled('reportFilterType')) {
            $filterType = $request->input('reportFilterType');

            if ($filterType === 'Solo Parent') {
                $query->where('status', 'Solo Parent');
            } else {
                $query->whereHas('services', function ($q) use ($filterType) {
                    $q->where('service_name', $filterType);
                });
            }
        }

        if ($request->filled('startDate')) {
            $startDate = $request->input('startDate');
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($request->filled('endDate')) {
            $endDate = $request->input('endDate');
            $query->whereDate('created_at', '<=', $endDate);
        }

        $beneficiaries = $query->with(['services', 'address'])
            ->orderBy('created_at', 'desc')
            ->get();

        Log::info('Filtered Beneficiaries:', $beneficiaries->toArray());

        return response()->json([
            'success' => true,
            'data' => $beneficiaries,
        ]);
    }
}
