<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyComposition extends Model
{
    use HasFactory;

    protected $table = 'families_composition';

    protected $fillable = [
        'intake_id',
        'composition_relation',
        'composition_name',
        'composition_live',
        'composition_agegender',
        'composition_civilstatus',
        'composition_employed',
        'composition_occupation',
        'composition_education',
        'composition_income',
        'composition_school',
        'composition_contact',
        'socio_economic',
        'children_num',
        'family_members',
        'family_household',
    ];

    public function intakeForm()
    {
        return $this->belongsTo(IntakeForm::class, 'intake_id');
    }
}
