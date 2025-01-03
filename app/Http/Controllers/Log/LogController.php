<?php

namespace App\Http\Controllers\Log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function getBeneficiaryTableData()
    {
        try {
            $beneficiaries = DB::table('beneficiaries')
                ->join('users', 'beneficiaries.user_id', '=', 'users.id')
                ->select(
                    'users.name as account_name',
                    DB::raw('CONCAT(beneficiaries.firstname, " ", beneficiaries.lastname) as beneficiary_name'),
                    'beneficiaries.created_at as date_added',
                    'beneficiaries.updated_at as date_updated'
                )
                ->orderBy('beneficiaries.created_at', 'desc')
                ->get();

            return response()->json(['beneficiaries' => $beneficiaries]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
