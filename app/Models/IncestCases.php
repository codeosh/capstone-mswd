<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncestCases extends Model
{
    use HasFactory;

    protected $table = 'incest_cases';

    protected $fillable = [
        'intake_id',
        'regular_arrangement',
        'regular_shelter',
        'regular_other',
        'same_bed',
        'same_room',
    ];

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_id');
    }
}
