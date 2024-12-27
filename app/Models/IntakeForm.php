<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'intake_date',
        'case_num',
        'relation_child',
        'social_worker',
        'other_information',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    public function primaryComplaints()
    {
        return $this->hasMany(IntakePrimaryComplaint::class, 'intake_id');
    }
    public function serviceSoughts()
    {
        return $this->hasMany(IntakeServiceSought::class, 'intake_id');
    }
    public function referralsFrom()
    {
        return $this->hasMany(IntakeReferralFrom::class, 'intake_id');
    }
    public function inpatientsFrom()
    {
        return $this->hasMany(IntakeInpatientFrom::class, 'intake_id');
    }
    public function patientsAdress()
    {
        return $this->hasOne(PatientAddress::class, 'intake_id');
    }
    public function familyComposition()
    {
        return $this->hasMany(FamilyComposition::class, 'intake_id');
    }
    public function incestCases()
    {
        return $this->hasMany(IncestCases::class, 'intake_id');
    }
    public function livingTimeAbuse()
    {
        return $this->hasMany(LivingTimeAbuse::class, 'intake_id');
    }
    public function livingAtPresent()
    {
        return $this->hasMany(LivingAtPresent::class, 'intake_id');
    }
}
