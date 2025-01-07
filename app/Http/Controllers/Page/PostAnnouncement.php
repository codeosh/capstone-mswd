<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\AnnouncementPost;
use App\Models\PostAnnouncement as ModelsPostAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostAnnouncement extends Controller
{
    public function index()
    {
        return view('page.post_announcement');
    }


    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string|max:65535',
            'media' => 'nullable',
            'media.*' => 'file|mimes:jpg,png,mp4|max:20971520',
        ]);

        $uploadedMedia = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('uploads/media', 'public');
                $uploadedMedia[] = $path;
            }
        }

        $postAnnouncement = AnnouncementPost::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'media_file' => json_encode($uploadedMedia),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Announcement posted successfully!',
            'data' => $postAnnouncement,
        ]);
    }
}
