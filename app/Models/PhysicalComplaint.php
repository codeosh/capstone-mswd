<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalComplaint extends Model
{
    use HasFactory;

    protected $table = 'physical_complaints';

    protected $fillable = [
        'interview_id',
        'physical_complaint',
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
