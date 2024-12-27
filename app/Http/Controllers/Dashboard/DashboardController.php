<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
