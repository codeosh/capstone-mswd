<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivingTimeAbuse extends Model
{
    use HasFactory;

    protected $table = 'arrangement_time_abuse';

    protected $fillable = [
        'intake_id',
        'living_arrangement',
        'ngo_shelter',
        'govt_agency',
    ];

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_id');
    }
}
