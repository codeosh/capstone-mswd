<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherIncident extends Model
{
    use HasFactory;

    protected $table = 'other_incidents';

    protected $fillable = [
        'interview_id',
        'other_incident',
        'duration_abuse',
        'witnessed',
        'site_abuse',
        'witness',
        'relation_child',
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
