<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewBefore extends Model
{
    use HasFactory;

    protected $table = 'interviewed_before';

    protected $fillable = [
        'interview_id',
        'interview_before',
        'other'
    ];

    public function interviewForm()
    {
        return $this->belongsTo(InterviewForm::class, 'interview_id');
    }
}
