<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class GenerateReport extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('perPage', 10);
        $beneficiaries = Beneficiary::with(['services', 'address'])
            ->orderBy('created_at', 'desc')
            ->limit($perPage)
            ->get();

        return view('page.generate_report', compact('beneficiaries'));
    }

    public function filterReport(Request $request)
    {
        $query = Beneficiary::query();
        $perPage = $request->get('perPage', 10);

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
            ->limit($perPage)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $beneficiaries,
        ]);
    }
}
