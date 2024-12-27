<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'interview_date',
        'case_num',
        'relation_child',
        'social_worker',
        'physician',
        'historian',
        'other_observer',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
    public function interviewedBefore()
    {
        return $this->hasMany(InterviewBefore::class, 'interview_id');
    }
    public function deferringInterview()
    {
        return $this->hasMany(DeferringInterview::class, 'interview_id');
    }
    public function disclosureAbuse()
    {
        return $this->hasMany(DisclosureAbuse::class, 'interview_id');
    }
    public function behaveioralChange()
    {
        return $this->hasMany(BehavioralChange::class, 'interview_id');
    }
    public function physicalComplaint()
    {
        return $this->hasMany(PhysicalComplaint::class, 'interview_id');
    }
    public function neglectComplaint()
    {
        return $this->hasMany(NeglectComplaint::class, 'interview_id');
    }
    public function incidents()
    {
        return $this->hasMany(Incident::class, 'interview_id');
    }
    public function otherIncidents()
    {
        return $this->hasMany(OtherIncident::class, 'interview_id');
    }
}
