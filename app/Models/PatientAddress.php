<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAddress extends Model
{
    use HasFactory;

    protected $table = 'patients_address';

    protected $fillable = [
        'intake_id',
        'mother_address',
        'mother_direction',
        'present_direction',
        'mother_telephone',
        'present_telephone',
        'present_caretaker',
        'legal_status',
        'relation_child',
        'enrolled_school',
        'educational_level',
        'family_contact',
        'family_address',
        'contact_relationchild',
    ];

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_id');
    }
}
