<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisclosureAbuse extends Model
{
    use HasFactory;

    protected $table = 'disclosure_abuses';

    protected $fillable = [
        'interview_id',
        'abuse_type',
        'psychotic_episode',
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
