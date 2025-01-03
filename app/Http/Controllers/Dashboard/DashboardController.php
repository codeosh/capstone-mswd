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
        try {
            // Fetch the necessary data for services and status
            $barangayData = DB::table('addresses')
                ->join('beneficiaries', 'beneficiaries.id', '=', 'addresses.beneficiary_id')
                ->leftJoin(
                    DB::raw('(SELECT DISTINCT beneficiary_id, service_name FROM services) as distinct_services'),
                    'beneficiaries.id',
                    '=',
                    'distinct_services.beneficiary_id'
                )
                ->select(
                    'addresses.barangay',
                    DB::raw('COUNT(DISTINCT beneficiaries.id) as total_beneficiaries'),
                    DB::raw('COUNT(DISTINCT CASE WHEN beneficiaries.status = "Solo Parent" THEN beneficiaries.id ELSE NULL END) as solo_parent_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "AICS" THEN 1 ELSE 0 END) as aics_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "VAW" THEN 1 ELSE 0 END) as vaw_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "VAC" THEN 1 ELSE 0 END) as vac_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "CAR" THEN 1 ELSE 0 END) as car_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "CICL" THEN 1 ELSE 0 END) as cicl_count')
                )
                ->groupBy('addresses.barangay')
                ->get();

            // Fetch sex distribution data for Pie Chart
            $currentDate = now()->toDateString(); // Convert to string for compatibility
            $sexDistribution = DB::table('beneficiaries')
                ->select(
                    DB::raw('SUM(CASE WHEN sex = "Male" THEN 1 ELSE 0 END) as male_count'),
                    DB::raw('SUM(CASE WHEN sex = "Female" THEN 1 ELSE 0 END) as female_count'),
                    DB::raw("SUM(CASE WHEN TIMESTAMPDIFF(YEAR, birthdate, '$currentDate') < 18 THEN 1 ELSE 0 END) as children_count"),
                    DB::raw("SUM(CASE WHEN TIMESTAMPDIFF(YEAR, birthdate, '$currentDate') > 60 THEN 1 ELSE 0 END) as senior_count")
                )
                ->first();


            // Fetch yearly trend data per service/status (for Bar Chart)
            $yearlyTrendData = DB::table('beneficiaries')
                ->leftJoin(
                    DB::raw('(SELECT DISTINCT beneficiary_id, service_name FROM services) as distinct_services'),
                    'beneficiaries.id',
                    '=',
                    'distinct_services.beneficiary_id'
                )
                ->select(
                    DB::raw('YEAR(beneficiaries.created_at) as year'),
                    DB::raw('COUNT(DISTINCT CASE WHEN beneficiaries.status = "Solo Parent" THEN beneficiaries.id ELSE NULL END) as solo_parent_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "AICS" THEN 1 ELSE 0 END) as aics_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "VAW" THEN 1 ELSE 0 END) as vaw_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "VAC" THEN 1 ELSE 0 END) as vac_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "CAR" THEN 1 ELSE 0 END) as car_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "CICL" THEN 1 ELSE 0 END) as cicl_count')
                )
                ->groupBy(DB::raw('YEAR(beneficiaries.created_at)'))
                ->get();

            return response()->json([
                'barangayData' => $barangayData,
                'yearlyTrendData' => $yearlyTrendData,
                'sexDistribution' => $sexDistribution
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
