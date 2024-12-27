<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $table = 'incidents';

    protected $fillable = [
        'interview_id',
        'info_from',
        'date_recent_incident',
        'time_recent_incident',
        'other_recent_clues',
        'date_first_abuse',
        'time_first_abuse',
        'other_first_abuse',
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
