<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiary;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin_index()
    {
        return view('dashboard.admin_dashboard');
    }

    public function personnel_index()
    {
        return view('dashboard.personnel_dashboard');
    }

    public function getBarangayData()
    {
        $barangayData = DB::table('beneficiaries')
            ->join('addresses', 'beneficiaries.id', '=', 'addresses.beneficiary_id')
            ->leftJoin('services', 'beneficiaries.id', '=', 'services.beneficiary_id')
            ->select(
                'addresses.barangay',
                DB::raw('COUNT(beneficiaries.id) as total_beneficiaries'),
                DB::raw('SUM(CASE WHEN beneficiaries.status = "Solo Parent" THEN 1 ELSE 0 END) as solo_parent_count'),
                DB::raw('SUM(CASE WHEN services.service_name = "AICS" THEN 1 ELSE 0 END) as aics_count'),
                DB::raw('SUM(CASE WHEN services.service_name = "VAW" THEN 1 ELSE 0 END) as vaw_count'),
                DB::raw('SUM(CASE WHEN services.service_name = "VAC" THEN 1 ELSE 0 END) as vac_count'),
                DB::raw('SUM(CASE WHEN services.service_name = "CAR" THEN 1 ELSE 0 END) as car_count'),
                DB::raw('SUM(CASE WHEN services.service_name = "CICL" THEN 1 ELSE 0 END) as cicl_count')
            )
            ->groupBy('addresses.barangay')
            ->get();

        return response()->json($barangayData);
    }
}
