<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\AnnouncementPost;
use Illuminate\Http\Request;

class BeneficiarySite extends Controller
{
    public function index()
    {
        $announcements = AnnouncementPost::with('user')->get();
        return view('page.beneficiary_site', compact('announcements'));
    }
}
