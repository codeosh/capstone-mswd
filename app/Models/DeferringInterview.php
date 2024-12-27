<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeferringInterview extends Model
{
    use HasFactory;

    protected $table = 'deferring_interviews';

    protected $fillable = [
        'interview_id',
        'deferring_interview',
        'deferring_other',
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
