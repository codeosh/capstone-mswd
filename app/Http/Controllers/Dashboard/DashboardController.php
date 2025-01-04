<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function getBarangayData(Request $request)
    {
        try {
            $filterType = $request->query('mapFilterType');
            $month = $request->query('selectMonthFilter');
            $year = $request->query('selectYearFilter');

            // Fetch the necessary data for services and status
            $query = DB::table('addresses')
                ->join('beneficiaries', 'beneficiaries.id', '=', 'addresses.beneficiary_id')
                ->leftJoin(
                    DB::raw('(SELECT DISTINCT beneficiary_id, service_name, MONTH(created_at) as service_month, YEAR(created_at) as service_year, created_at FROM services) as distinct_services'),
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
                ->groupBy('addresses.barangay');

            // Apply filters
            if ($filterType) {
                $query->where('distinct_services.service_name', $filterType);
            }

            if ($month) {
                $query->where(DB::raw('MONTH(distinct_services.created_at)'), '=', $month);
            }

            if ($year) {
                $query->where(DB::raw('YEAR(distinct_services.created_at)'), '=', $year);
            }

            $barangayData = $query->get();

            // Fetch sex distribution data for Pie Chart
            $currentDate = now()->toDateString();
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
                    DB::raw('(SELECT DISTINCT beneficiary_id, service_name, MONTH(created_at) as service_month, YEAR(created_at) as service_year FROM services) as distinct_services'),
                    'beneficiaries.id',
                    '=',
                    'distinct_services.beneficiary_id'
                )
                ->select(
                    DB::raw('distinct_services.service_year as year'), // Use service_year from the subquery
                    DB::raw('COUNT(DISTINCT CASE WHEN beneficiaries.status = "Solo Parent" THEN beneficiaries.id ELSE NULL END) as solo_parent_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "AICS" THEN 1 ELSE 0 END) as aics_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "VAW" THEN 1 ELSE 0 END) as vaw_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "VAC" THEN 1 ELSE 0 END) as vac_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "CAR" THEN 1 ELSE 0 END) as car_count'),
                    DB::raw('SUM(CASE WHEN distinct_services.service_name = "CICL" THEN 1 ELSE 0 END) as cicl_count')
                )
                ->whereNotNull('distinct_services.service_year') // Exclude records with null year
                ->groupBy('distinct_services.service_year')
                ->get();

            if ($month) {
                // Use the alias `service_month` instead of `created_at`
                $yearlyTrendData->where('distinct_services.service_month', '=', $month);
            }

            if ($year) {
                // Use the alias `service_year` instead of `created_at`
                $yearlyTrendData->where('distinct_services.service_year', '=', $year);
            }




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
