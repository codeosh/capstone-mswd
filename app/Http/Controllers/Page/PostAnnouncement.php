<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostAnnouncement extends Controller
{
    public function index()
    {
        return view('page.post_announcement');
    }
}
