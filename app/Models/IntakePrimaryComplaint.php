<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakePrimaryComplaint extends Model
{
    use HasFactory;

    protected $table = 'primary_complaints';

    protected $fillable = [
        'intake_id',
        'primary_complaint',
    ];

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_id');
    }
}
