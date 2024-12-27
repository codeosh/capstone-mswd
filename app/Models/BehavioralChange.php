<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehavioralChange extends Model
{
    use HasFactory;

    protected $table = 'behavioral_changes';

    protected $fillable = [
        'interview_id',
        'behavioral_type',
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
