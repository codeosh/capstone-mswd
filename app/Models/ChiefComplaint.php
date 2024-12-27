<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiefComplaint extends Model
{
    use HasFactory;

    protected $table = 'chief_complaints';

    protected $fillable = [
        'interview_id',
        'disclosure_abuse',
        'behavioral_change',
        'physical_complaint',
        'neglect',
        'psychotic_episode',
        'neglect_other',
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
