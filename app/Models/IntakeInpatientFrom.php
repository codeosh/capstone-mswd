<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeInpatientFrom extends Model
{
    use HasFactory;

    protected $table = 'inpatients_from';

    protected $fillable = [
        'intake_id',
        'type',
        'inpatient_from',
        'inpatient_other',
    ];

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_id');
    }
}
