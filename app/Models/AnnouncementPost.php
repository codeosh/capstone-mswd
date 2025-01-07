<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementPost extends Model
{
    use HasFactory;

    protected $table = 'announcements';

    protected $fillable = [
        'user_id',
        'caption',
        'media_file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
