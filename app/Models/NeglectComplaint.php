<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeglectComplaint extends Model
{
    use HasFactory;

    protected $table = 'neglect_complaints';

    protected $fillable = [
        'interview_id',
        'neglect_complaint',
        'neglect_other',
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
